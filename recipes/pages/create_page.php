<?php
/*
This program shows how to create a page associated with a data definition.
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
    // the site
    $site_name = "cascade-admin-old";
    // the parent folder
    $base_folder = $cascade->getAsset( a\Folder::TYPE, '/', $site_name );

    // the content type to be associated with the new page
    $ct = $cascade->getAsset( a\ContentType::TYPE, '1378b3e38b7f08ee1890c1e4df869132' );

    if( !is_null( $ct->getDataDefinition() ) )
    {
        // the new page
        $page_name = 'my_test_page';
        $page      = $cascade->createDataDefinitionPage( $base_folder, $page_name, $ct );
    }
    else
    {
        echo "The content type is not associated with a data definition.";
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