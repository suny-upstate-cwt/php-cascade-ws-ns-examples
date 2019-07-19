<?php
/*
This program shows how to switch the content type associated with pages in a site.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$site_name   = "standard-model";
$folder_path = "source";

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();

    // _brisk/XML
    $ct     = $admin->getAsset( a\ContentType::TYPE, "dcbe90de8b7f08ee67410e21acf39749" );
    $format = 
      $admin->getAsset( a\ScriptFormat::TYPE, "77e8ba858b7f08ee495d8956d3125494" );

    $params = array(
    	'ct'     => $ct,
    	'format' => $format
    );
    		
    $admin->getAsset( a\Folder::TYPE, $folder_path, $site_name )->getAssetTree()->
    	traverse(
    		array(
    			a\Page::TYPE => array( "assetTreeSwitchXmlContentType" )
    		),
    		$params
    	);

    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
function assetTreeSwitchXmlContentType( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, array $params=NULL, array &$results=NULL )
{

    if( !isset( $params[ 'ct' ] ) )
        throw new \Exception( "The content type is not included" );
    if( !isset( $params[ 'format' ] ) )
        throw new \Exception( "The format is not included" );
    
    $ct     = $params[ 'ct' ];
    $format = $params[ 'format' ];

    $type = $child->getType();
    
    if( $type != a\Page::TYPE )
        return;
        
    $asset = $child->getAsset( $service );
    
    // skip the index page
    if( $asset->getName() == "index" )
    	return;
    	
    $asset->setContentType( $ct );
    $asset->setRegionBlock( "XML", "DEFAULT", NULL )->
    	setRegionFormat( "XML", "DEFAULT", $format )->
    	setText( "main-group;h1", $asset->getName() )->
    	edit();
}

?>