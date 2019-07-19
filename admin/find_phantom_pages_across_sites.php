<?php
/*
This program can be used to find all pages with phantom nodes in a Cascade instance.
Note that this program can take a very long time to execute.
*/
require_once( 'auth_REST_SOAP.php' );

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
	$results = array();
	
	$site_ids = $admin->getSites();
	
	foreach( $site_ids as $site_id )
	{
		$site_name = $site_id->getPathPath();
		$results[ $site_name ] = array();
		
		$site_id->getAsset( $service )->
        	getBaseFolderAssetTree()->
        	traverse( 
            	array( a\Page::TYPE => array( "assetTreeReportPhantomNodes" ) ), 
            	NULL, 
            	$results[ $site_name ] );
	}
	
	u\DebugUtility::dump( $results );
	
	u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
	echo S_PRE . $er . E_PRE;
	u\DebugUtility::outputDuration( $start_time );
}
?>