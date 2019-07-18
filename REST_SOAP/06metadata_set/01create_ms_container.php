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
    $site_name = "cancer-test";
    $msc_name  = "Test MS Container";
    $msc = $admin->getMetadataSetContainer( $msc_name, $site_name );
    
    if( isset( $msc ) )
    {
        $admin->deleteAsset( $msc );
    }
    
    $msc = $admin->createMetadataSetContainer(
        $admin->getAsset( a\MetadataSetContainer::TYPE, "/", $site_name ),
        $msc_name
    )->dump();
    
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