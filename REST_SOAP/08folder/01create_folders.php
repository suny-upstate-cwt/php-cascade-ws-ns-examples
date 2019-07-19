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
    $site_name   = "cancer-test";
    $root_folder = $admin->getAsset( a\Folder::TYPE, "/", $site_name );
    $root_folder->deleteAllChildren();
    
    $folder_paths = array(
        "_cascade"               => array( "/", "_cascade" ),
        "_cascade/blocks"        => array( "_cascade", "blocks" ),
        "_cascade/blocks/code"   => array( "_cascade/blocks", "code" ),
        "_cascade/blocks/data"   => array( "_cascade/blocks", "data" ),
        "_cascade/blocks/index"  => array( "_cascade/blocks", "index" ),
        "_cascade/blocks/script" => array( "_cascade/blocks", "script" ),
        "_cascade/formats"       => array( "_cascade", "formats" ),
        "_cascade/template"      => array( "_cascade", "template" ),
        "_extra"                 => array( "/", "_extra" )
    );
    
    foreach( $folder_paths as $folder_path => $array )
    {
        $parent = $admin->getAsset( a\Folder::TYPE, $array[ 0 ], $site_name );
        $admin->createFolder(
            $parent,
            $array[ 1 ],
            $site_name
        );
        sleep( 1 );
    }
    
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