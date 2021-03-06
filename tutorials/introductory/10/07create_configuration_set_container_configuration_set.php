<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name        = 'web-service-test';
    $desktop_template = 
        $cascade->getAsset( a\Template::TYPE, 'templates/three-columns', $site_name );
    $xml_template     = 
        $cascade->getAsset( a\Template::TYPE, 'templates/xml', $site_name );
        
    // create a text block to be attached to a region at the config level
    $block_folder  =
        $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
    $code = "<div id='top-graphics'>Top Graphics</div>";
        
    $top_graphics = $cascade->createTextBlock(
        $block_folder,
        'top-graphics',
        $code );
        
    // create configuration set container
    $parent = $cascade->createPageConfigurationSetContainer(
        $cascade->getAsset( a\PageConfigurationSetContainer::TYPE, '/', $site_name ),
        'Test Configuration Set Container'
    );
    
    // create configuration set with default configuration
    $pcs = $cascade->createPageConfigurationSet(
        $parent,           // parent container
        'Three Columns',   // configuration set name
        'Desktop',         // default configuration name
        $desktop_template, // template
        '.php',            // file extension
        c\T::HTML          // serialization type
    )->
    // attach a block to a region at config level
    setConfigurationPageRegionBlock( 
        'Desktop', 'TOP GRAPHICS', $top_graphics )->
    edit();
    
    // add xml configuration
    $pcs->addPageConfiguration( 'XML', $xml_template, '.xml', c\T::XML );
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