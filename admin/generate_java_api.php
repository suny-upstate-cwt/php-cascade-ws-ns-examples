<?php
/*
This program is used to generate the pages in http://www.upstate.edu/java/api-documentation/index.php
*/
require_once( 'auth_REST_SOAP.php' );
require_once( 'java_api_classes.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
	u\DebugUtility::setTimeSpaceLimits();
	
	$siteName = "java";
	$rootPath = "/api-documentation/";
	$folderMS = $admin->getAsset(
		a\MetadataSet::TYPE, "413668b08b7f08ee0ed2ecda389f5daa" );
	$pageCT   = $admin->getAsset( 
		a\ContentType::TYPE, "4224297e8b7f08ee0ed2ecda7b51db59" );
	$apiBlock = $admin->getAsset(
		a\DataBlock::TYPE, "4b7064cd8b7f08ee72410d245689237a" );
	$cache = array();
	
	$rootFolder = $admin->getAsset( a\Folder::TYPE, $rootPath, $siteName );

	// a class name is a fully qualified one like com.cms.publish.PublishTrigger
	foreach( $java_api_classes as $className )
	{
		$pathSegments  = explode( ".", $className );
		$size          = count( $pathSegments );
		$parentPath    = "";
		
		for( $i = 0;  $i < $size - 1; $i++ )
		{
			$parentPath = $rootPath . implode( '/', array_slice( $pathSegments, 0, $i ) );
			$path       = $rootPath . implode( '/', array_slice( $pathSegments, 0, $i + 1 ) );
			
			//u\DebugUtility::dump( $parentPath );
			//u\DebugUtility::dump( $path );
			
			// check if the parent folder is in the cache
			// if not, put it in the cache
			if( !isset( $cache[ $parentPath ] ) )
			{
				$parentFolder =
					$admin->getAsset( a\Folder::TYPE, $parentPath, $siteName );
				$cache[ $parentPath ] = $parentFolder;
			}
			// retrieve folder from cache
			else
			{
				$parentFolder = $cache[ $parentPath ];
			}
			
			// check if current folder is in the cache
			// if not, put it in the cache
			if( !isset( $cache[ $path ] ) )
			{
				// try to retrieve the folder
				$folder = $admin->getFolder( $path, $siteName );
				
				// the folder does not exist
				if( is_null( $folder ) )
				{
					// create the folder
					$folder = $admin->createFolder( $parentFolder, $pathSegments[ $i ] );
					$folder->setMetadataSet( $folderMS )->
						getMetadata()->setDisplayName( $pathSegments[ $i ] )->
						getHostAsset()->edit();
					// create index page for the new folder
					$indexPage = $admin->createPage( $folder, "index", $pageCT );
					$indexPage->getMetadata()->setTitle( $pathSegments[ $i ] )->
						setDisplayName( $pathSegments[ $i ] )->
						getHostAsset()->
						setText( "main-group;h1", $pathSegments[ $i ] )->edit();
				}
				// put folder in the cache
				$cache[ $path ] = $folder;
			}
			// retrieve folder from cache
			else
			{
				$folder = $cache[ $path ];
			}
		}

		// find the page name
		$className = $pathSegments[ $size - 1 ];
		$className = preg_replace( "([A-Z])", "-$0", $className );
		$className = strtolower( $className );
		$pageName  = substr( $className, 1 );  // remove leading -
		$pageName  = str_replace( '$', '', $pageName );
		
		if( $pageName == "" ) // empty string
		{
			continue;
		}
		
		// try to retrieve the page
		if( !isset( $cache[ $folder->getPath() . '/' . $pageName ] ) )
		{
			$page = $admin->getPage( $folder->getPath() . '/' . $pageName, $siteName );
			// page does not exist
			if( is_null( $page ) )
			{
				$page = $admin->createPage( $folder, $pageName, $pageCT );
				$page->getMetadata()->setTitle( $pathSegments[ $size - 1 ] )->
						setDisplayName( $pathSegments[ $size - 1 ] )->
						getHostAsset()->
						setText( "main-group;h1", $pathSegments[ $size - 1 ] )->
						setBlock( "main-group;mul-post-h1-chooser;0", $apiBlock )->
						edit();
			}
			else
			{
				// do nothing
			}
			// put page into cache, though not necessary
			$cache[ $folder->getPath() . '/' . $pageName ] = $page;
		}
	}
	
	// before republishing, reorder the folders and pages
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
?>