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
    $parent_folder_path = "_cascade/template";
    $parent_folder      = $admin->getAsset(
        a\Folder::TYPE, $parent_folder_path, $site_name );
    $template_name      = "xml";
    $xml = '<system-region name="DEFAULT"/>';
        
    $t = $admin->getTemplate( "$parent_folder_path/$template_name", $site_name );
    
    if( isset( $t ) )
    {
        $admin->deleteAsset( $t );
    }
        
    $t = $admin->createTemplate( $parent_folder, $template_name, $xml );

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