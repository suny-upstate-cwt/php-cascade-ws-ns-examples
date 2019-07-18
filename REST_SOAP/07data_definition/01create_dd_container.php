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
    $ddc_name  = "Test DD Container";
    $ddc = $admin->getDataDefinitionContainer( $ddc_name, $site_name );
    
    if( isset( $ddc ) )
    {
        $admin->deleteAsset( $ddc );
    }
    
    $ddc = $admin->createDataDefinitionContainer(
        $admin->getAsset( a\DataDefinitionContainer::TYPE, "/", $site_name ),
        $ddc_name
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