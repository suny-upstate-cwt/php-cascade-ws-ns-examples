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
    $root_container = $admin->getAsset( a\TransportContainer::TYPE, "/", "_common" );

    $tc_name = "Test Transport Container";
    $tc      = $admin->getTransportContainer( $tc_name, "_common" );

    if( isset( $tc ) )
    {
        $admin->deleteAsset( $tc );
    }
        
    $tc = $admin->createTransportContainer( $root_container, $tc_name )->dump();
    
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