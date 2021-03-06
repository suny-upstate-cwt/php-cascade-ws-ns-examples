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
    $block_folder  =
        $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
    $file_folder   =
        $cascade->getAsset( a\Folder::TYPE, 'files', $site_name );
    $ct            = $cascade->getAsset( 
        a\ContentType::TYPE, 
        'Test Content Type Container/Normal XHTML', $site_name );
    
    // create a content type index block
    // NOTE: if the wrong type is fed in, the error message will be
    // A domain object failed validation
    $cib = $cascade->createIndexBlock(
        $block_folder,
        'normal-xhtml-index',
        c\T::CONTENTTYPEINDEX,
        $ct
    );
    
    // create a folder index block
    $cib = 
        $cascade->createIndexBlock(
            $block_folder,
            'folder-index',
            c\T::FOLDER,
            NULL,
            $file_folder
        )->
        setDepthOfIndex( 5 )->
        setIndexFiles( true )->
        setIndexPages( true )->
        setFolder(
            $cascade->getAsset( a\Folder::TYPE, '/', $site_name ) // Base Folder
        )->
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