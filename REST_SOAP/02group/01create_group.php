<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $group_name = "test-ws-group";
    // cannot deal with multiple roles because in WS, only one role is read
    $role_name  = "Administrator"; // one global role only
    $group      = $admin->getGroup( $group_name );

    if( isset( $group ) )
    {
        echo "Deleting group", BR;
        $user_names = explode( ";", $group->getUsers() );
        
        // remove all users first, or else the group cannot be deleted
        foreach( $user_names as $user_name )
        {
            if( $user_name != "" )
            {
                $group->removeUserName( $user_name );
            }
        }
        $group->edit();
        $admin->deleteAsset( $group );
    }

    $group = $admin->createGroup( $group_name, $role_name );
    
    // add the users back
    if( isset( $user_name ) )
    {
        foreach( $user_names as $user_name )
        {
            if( $user_name != "" )
            {
                $group->addUserName( $user_name );
            }
        }
        $group->edit();
    }
    
    $group->edit()->dump();
    
    if( $service->isRest() )
    {
        u\DebugUtility::dumpRESTCommands( $service );
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
?>