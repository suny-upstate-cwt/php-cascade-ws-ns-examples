<?php 
/*
This program shows how to set dynamic values.
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
    $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' )->
    	getMetadata()->
        // uncheck the checkbox
        setDynamicFieldValue( "exclude-from-left" )->
        // or setDynamicFieldValue( "exclude-from-left", NULL )->
        // or setDynamicFieldValue( "exclude-from-left", array( NULL ) )->
        // check the checkbox
        setDynamicFieldValue( "exclude-from-menu", array( 'Yes' ) )->
        getHostAsset()->edit();
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