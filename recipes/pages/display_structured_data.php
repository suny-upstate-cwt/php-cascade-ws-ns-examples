<?php 
/*
This program shows how to loop through the fully qualified identifiers
of a structured data object.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name   = "cascade-admin-old";
    $page_name   = "test/new-page";
    $page        = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    $identifiers = $page->getIdentifiers();
    
    foreach( $identifiers as $identifier )
    {
        if( $page->getNodeType( $identifier ) == 'text' )
        {
            echo "A text node found with value " . 
                $page->getText( $identifier ) . BR;
        }
        else if( $page->getNodeType( $identifier ) == 'group' )
        {
            $group_node = $page->getStructuredData()->getNode( $identifier );
            $children   = $group_node->getStructuredDataNodes();
            
            if( !is_null( $children ) )
            {
                echo "A group node found with children ";
                
                foreach( $children as $child )
                {
                    echo $child->getIdentifier() . ", ";
                }
                echo BR;
            }
        }
        else if( $page->getNodeType( $identifier ) == 'asset' )
        {
            echo "An asset node found" . BR;
            
            $asset_node = $page->getStructuredData()->getNode( $identifier );
            
            if( !is_null( $asset_node->getBlockId() ) )
            {
                echo "Block ID " . $asset_node->getBlockId() . BR;
            }
            else if( !is_null( $asset_node->getFileId() ) )
            {
                echo "File ID " . $asset_node->getFileId() . BR;
            }
            else if( !is_null( $asset_node->getPageId() ) )
            {
                echo "Page ID " . $asset_node->getPageId() . BR;
            }
            else if( !is_null( $asset_node->getSymlinkId() ) )
            {
                echo "Symlink ID " . $asset_node->getSymlinkId() . BR;
            }
        }
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