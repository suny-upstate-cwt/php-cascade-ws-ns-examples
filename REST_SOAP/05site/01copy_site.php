<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
	u\DebugUtility::setTimeSpaceLimits();

    $site = $admin->getSite( "cancer-test" );
    
    try
    {
        $new_site = $admin->getSite( "cancer-test-copy" );
        $admin->deleteAsset( $new_site );
    }
    catch( e\NoSuchSiteException $e )
    {
        // do nothing
    }
    
    // let the deletion complete properly
    sleep( 15 );
    
    $new_site = $admin->copySite( $site, "cancer-test-copy" );
    $new_site->dump();
    
    if( $service->isRest() )
    {
        u\DebugUtility::dumpRESTCommands( $service );
    }
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
?>