<?php
/*
This program only works with REST.
As of Cascade 8.13, the bugs existing in SOAP have not been fixed.
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
    $site = $admin->getSite( "cancer-test" )->dump();
    $asset_array = array( "page", "file" );
   
    $site->setNamingRuleAssets( $asset_array )->
        setNamingRuleCase( a\Site::LOWER_CASE )->
        setNamingRuleSpacing( a\Site::REMOVE_SPACE )->edit()->dump();
        
    $site->removeNamingRuleAsset( "template" )->edit()->dump();
    
    $site->clearNamingRuleAssets()->edit()->dump();
    
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