<?php
/*
This program shows how to remove a tag from a page.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$page = $admin->getAsset( a\Page::TYPE, "f980f2938b7f08ee78de879e9b439a4b" );
	
	if( $page->hasTag( "news-Bioethics in Brief" ) )
	{
		$page->removeTag( "news-Bioethics in Brief" )->edit();
	}
	
	$tags = $page->getTags();
	u\DebugUtility::dump( $tags );
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