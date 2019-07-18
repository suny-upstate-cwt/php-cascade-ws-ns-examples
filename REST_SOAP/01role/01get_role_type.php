<?php
/*
A role can be either global or site. They define different abilities.
Use getRoleType to get the type string.
*/
require_once( 'auth_REST_SOAP.php' );
require_once( 'role_constants.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // global
    $role = $admin->getRole( $global_role_id );
    echo "Role type: ", $role->getRoleType(), BR;
    
    // site
    $role = $admin->getRole( $site_role_id );
    echo "Role type: ", $role->getRoleType(), BR;
    
    u\DebugUtility::dumpRESTCommands( $service );
    /*/
outputs:

array(2) {
  [0]=>
  array(1) {
    ["command"]=>
    string(48) "https://mydomain.edu:1234/api/v1/read/role/131"
  }
  [1]=>
  array(1) {
    ["command"]=>
    string(46) "https://mydomain.edu:1234/api/v1/read/role/5"
  }
}
    /*/
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