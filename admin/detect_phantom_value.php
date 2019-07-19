<?php
/*
This program can be used to detect and remove phantom values in a data definition block.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$block_id = "669a6b368b7ffe8347b1526e607ab176";

try
{
    $block = $admin->getAsset( a\DataDefinitionBlock::TYPE, $block_id );
    //$block->dump();
    
    u\DebugUtility::out(
        u\StringUtility::boolToString( $block->getStructuredData()->hasPhantomValues() )
    );
    
    $block->removePhantomValues()->dump();
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