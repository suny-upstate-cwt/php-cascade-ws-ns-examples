<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name     = 'web-service-test';
    $images_folder = $cascade->getAsset( a\Folder::TYPE, 'images', $site_name );
    $files_folder  = $cascade->getAsset( a\Folder::TYPE, 'files', $site_name );
    
    $css = array(
        "local.css" => "http://www.upstate.edu/cascade-admin/_extra/local.css",
        "upstate-mini-menu-1.0.0.css" => "http://www.upstate.edu/assets/css/upstate-mini-menu-1.0.0.css"
    );
    
    $images = array(
        "upstate-academics-homepage.jpg" => "http://www.upstate.edu/_extra/images/slideshow/upstate-academics-homepage.jpg",
        "clinical-patientcare.jpg" => "http://www.upstate.edu/_extra/images/slideshow/clinical-patientcare.jpg"
    );
    
    foreach( $css as $file_name => $url )
    {
        $cascade->createFile( 
            $files_folder,            // parent
            $file_name,               // filename
            file_get_contents( $url ) // text
        );
    }
    
    foreach( $images as $file_name => $url )
    {
        $cascade->createFile( 
            $images_folder, 
            $file_name,
            "",                       // text
            file_get_contents( $url ) // binary data
        );
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