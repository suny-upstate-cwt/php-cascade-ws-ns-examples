<?php 
/*
This program shows how to copy all data from the source page
to the target page. This assumes that the two pages are associated
with the same data definition.
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
    $source_page = $cascade->getAsset( a\Page::TYPE, '980d70d98b7f0856015997e4b00790fe' );
    $target_page = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );
    
    // copy all page contents in DEFAULT
    $target_page->setStructuredData(
        $source_page->getStructuredData()
    );
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