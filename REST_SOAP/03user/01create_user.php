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
    $user_name = "test-ws-user";
    $user      = $admin->getUser( $user_name );
    $group     = $admin->getAsset( a\Group::TYPE, "test-ws-group" );
    $role      = $admin->getAsset( a\Role::TYPE, 10 );

    if( isset( $user ) )
    {
        u\DebugUtility::out( "Deleting user" );
        $admin->deleteAsset( $user );
    }
    else
    {
        echo "User does not exist", BR;
    }
    
    $user = $admin->createUser( $user_name, "password", $group, $role );
    $user->dump();
    
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