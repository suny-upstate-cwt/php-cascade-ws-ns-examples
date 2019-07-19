<?php
/*
This program can be used to force a publish command on every page and file in a site.
The publishAllFilesPages method is defined in the Administration class.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$site_name   = "formats";
$folder_path = "velocity/courses/exercises";

try
{
    $admin->publishAllFilesPages( $site_name, $folder_path );
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