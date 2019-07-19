<?php
/*
This program is used to find pages with blocks attached to
a specific block chooser. It also shows how to continue processing
by ignoring exceptions.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$site_name = "cwt-cascade-docs";

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    $phantom = "phantom";
    $value   = "phantom-value";
    $params  = array( $phantom, $value );
    $results = array();
    $results[ $phantom ] = array();
    
    $results[ $site_name ] = array();
    $results[ $phantom ]   = array();
    $results[ $value ]     = array();
    
    $admin->getSite( $site_name )->
        getBaseFolderAssetTree()->
        traverse( 
            array( a\Page::TYPE => array( "assetTreeReportPagesWithPageLevelOverride" ) ), 
            $params, 
            $results[ $site_name ] );
    
    // remove empty entries
    if( sizeof( $results[ $phantom ] ) == 0 )
        unset( $results[ $phantom ] );
    if( sizeof( $results[ $value ] ) == 0 )
        unset( $results[ $value ] );

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

function assetTreeReportPagesWithPageLevelOverride(
    aohs\AssetOperationHandlerService $service,
    p\Child $child, array $params=NULL, array &$results=NULL )
{
    // skip irrelevant children
    $type  = $child->getType();
    
    if( $type != a\Page::TYPE && $type != a\DataDefinitionBlock::TYPE )
    {
        return;
    }

    try
    {
        $page = $child->getAsset( $service );
        
        if( !is_null( $page->getBlock( "admin-group;page-level-override" ) ) )
        {
            $results[] = $child->getPathPath();
        }
    }
    // skip pages that cannot be dealt with
    // xhtml pages
    catch( e\WrongPageTypeException $e )
    {
        return;
    }
    // drafts
    catch( e\NullAssetException $e )
    {
        return;
    }
    // phantom pages
    catch( e\NoSuchFieldException $e )
    {
        $results[ $params[ 0 ] ][] = $child->getId();
    }
    // phantom values
    catch( e\MissingDefaultValueException $e )
    {
        $results[ $params[ 1 ] ][] = $child->getId();
    }
}
?>