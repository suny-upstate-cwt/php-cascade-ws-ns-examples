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
    $admin->getAsset( a\Folder::TYPE, "_cascade", $site_name )->
        setShouldBeIndexed( false )->
        setShouldBePublished( false )->
        edit();
    $admin->getAsset( a\Folder::TYPE, "_extra", $site_name )->
        setShouldBeIndexed( false )->
        setShouldBePublished( true )->
        edit();
    
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