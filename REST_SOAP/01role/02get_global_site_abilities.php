<?php
/*
A global role defines global abilities.
A site role defines site abilities.
Use getGlobalAbilities to get the GlobalAbilities object.
Use getSiteAbilities to get the SiteAbilities object.
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
    $role_id = $global_role_id;
    //$role_id = $site_role_id;
    $role    = $admin->getRole( $role_id );
    
    if( $role->getRoleType() == "global" )
    {
        $abilities = $role->getGlobalAbilities();
    }
    else
    {
        $abilities = $role->getSiteAbilities();
    }
        
    echo $role->getRoleType(), BR;
    u\DebugUtility::dump( $abilities->toStdClass() );
    
    if( $service->isRest() )
    {
        u\DebugUtility::dumpRESTCommands( $service );
    }
    
/*/
outputs:

global
/Applications/MAMP/htdocs/rest_soap/01role/02get_global_site_abilities.php::30: 
object(stdClass)#17 (37) {
  ["accessAllSites"]=>
  bool(true)
  ["accessAudits"]=>
  bool(false)
  ["accessConfiguration"]=>
  bool(false)
  ["accessDefaultEditorConfiguration"]=>
  bool(false)
  ["accessRoles"]=>
  bool(false)
  ["accessSecurityArea"]=>
  bool(false)
  ["accessSiteManagement"]=>
  bool(false)
  ["broadcastMessages"]=>
  bool(false)
  ["bypassAllPermissionsChecks"]=>
  bool(false)
  ["changeIdentity"]=>
  bool(false)
  ["configureLogging"]=>
  bool(false)
  ["createGroups"]=>
  bool(false)
  ["createRoles"]=>
  bool(false)
  ["createSites"]=>
  bool(false)
  ["createUsers"]=>
  bool(false)
  ["databaseExportTool"]=>
  bool(false)
  ["deleteAllUsers"]=>
  bool(false)
  ["deleteAnyGroup"]=>
  bool(false)
  ["deleteMemberGroups"]=>
  bool(false)
  ["deleteUsersInMemberGroups"]=>
  bool(false)
  ["diagnosticTests"]=>
  bool(false)
  ["editAccessRights"]=>
  bool(false)
  ["editAnyGroup"]=>
  bool(false)
  ["editAnyUser"]=>
  bool(false)
  ["editMemberGroups"]=>
  bool(false)
  ["editSystemPreferences"]=>
  bool(false)
  ["editUsersInMemberGroups"]=>
  bool(false)
  ["forceLogout"]=>
  bool(false)
  ["modifyDictionary"]=>
  bool(false)
  ["optimizeDatabase"]=>
  bool(false)
  ["searchingIndexing"]=>
  bool(false)
  ["syncLdap"]=>
  bool(false)
  ["viewAllGroups"]=>
  bool(false)
  ["viewAllUsers"]=>
  bool(false)
  ["viewMemberGroups"]=>
  bool(false)
  ["viewSystemInfoAndLogs"]=>
  bool(false)
  ["viewUsersInMemberGroups"]=>
  bool(false)
}

/Applications/MAMP/htdocs/rest_soap/01role/02get_global_site_abilities.php::32: 
array(1) {
  [0]=>
  array(1) {
    ["command"]=>
    string(52) "https://mydomain.edu:1234/api/v1/read/role/10"
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