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
    $site_name = "cancer-test-copy";
    
    try
    {
        $site = $admin->getSite( $site_name )->dump(); // inheritDataChecksEnabled
        $admin->deleteAsset( $site );
    }
    catch( e\NoSuchSiteException $e )
    {
        //u\DebugUtility::dump( "No such site" );
    }
    
    $admin->createSite( 
        $site_name,
        "http://www.upstate.edu",
        c\T::FIFTEEN )->dump();
    
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