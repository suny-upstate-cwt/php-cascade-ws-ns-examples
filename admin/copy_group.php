<?php
/*
This program can be used to create a new group out of an existing group.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $old_group_name = "22q";
    $new_group_name = "new-22q";
    
    $old_group = $admin->getAsset( a\Group::TYPE, $old_group_name );
    //$old_group->dump();
    
    $new_group = $old_group->copyGroup( $new_group_name );
    //$new_group->dump();
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