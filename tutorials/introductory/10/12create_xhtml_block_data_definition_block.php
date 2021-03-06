<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'web-service-test';
        
    // create an xhtml block to be attached to a region at the page level
    $block_folder  =
        $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
    $code = "<p>Some content.</p>";
        
    $xhtml_block = $cascade->createXhtmlDataDefinitionBlock(
        $block_folder,
        'xhtml-block',
        NULL, // data definition
        $code );
        
    // create a data definition block to be attached to a region at the page level
    $data_definition =
        $cascade->getAsset( 
            a\DataDefinition::TYPE, 
            'Test Data Definition Container/Simple Text', $site_name );
    
    $xhtml_block = 
        $cascade->createXhtmlDataDefinitionBlock(
            $block_folder,
            'simple-text-block',
            $data_definition )->
        setText( 'text', 'Some content for the data block.' )->
        edit();
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