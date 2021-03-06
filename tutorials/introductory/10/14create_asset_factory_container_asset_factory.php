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
    $base_folder  = 
        $cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolder();
    
    // create asset factory container
    $parent = $cascade->createAssetFactoryContainer(
        $cascade->getAsset( 
            a\AssetFactoryContainer::TYPE, '/', $site_name ),
            'Site Managers'
    );
    
    $group = $cascade->getAsset( a\Group::TYPE, 'web-service-test-group' );
    
    // grant access to container
    $ari   = $cascade->getAccessRights( 
        a\AssetFactoryContainer::TYPE, 'Site Managers', $site_name );
    $ari->addGroupReadAccess( $group );     // read access
    $cascade->setAccessRights( $ari );
        
    // create base assets folder
    $ba_folder = 
        $cascade->
            createFolder(
                $base_folder, // parent folder
                '_base-assets' )->
            setShouldBeIndexed( false )->   // all not indexable
            setShouldBePublished( false )-> // all not publishable
            edit(); // commit!!!
    
    // create base page
    $bp = $cascade->getAsset( a\Page::TYPE, 'test', $site_name )->
        copy( $ba_folder, 'new-page' );
        
    // create asset factory
    $af =
        $cascade->
            createAssetFactory(
                $parent,    // container
                'New Page', // name
                a\Page::TYPE, // asset type
                c\T::NONE     // workflow mode
            )->
            setBaseAsset( $bp )->
            addGroup( $group )->
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