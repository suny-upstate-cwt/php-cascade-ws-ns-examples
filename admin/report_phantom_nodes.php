<?php
/*
This program can be used to report phantom nodes in pages and data definition blocks within
a site.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$site_name = "cancer";

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    $results = array();
    $admin->reportPhantomNodes( $site_name, NULL, $results );
    u\DebugUtility::dump( $results );
    u\DebugUtility::outputDuration( $start_time );
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