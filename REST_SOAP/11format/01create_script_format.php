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
    $site_name          = "cancer-test";
    $parent_folder_path = "_cascade/formats";
    $format_name        = "default";
    
    $format = $admin->getScriptFormat(
        "$parent_folder_path/$format_name", $site_name );
    
    if( isset( $format ) )
        $admin->deleteAsset( $format );
        
    $format = $admin->createScriptFormat(
        $admin->getAsset( a\Folder::TYPE, $parent_folder_path, $site_name ),
        $format_name,
        "##"
    );

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