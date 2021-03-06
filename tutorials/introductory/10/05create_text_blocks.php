<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name      = 'web-service-test';
    $parent_folder  =
        $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
    $code = "<!--#passthrough<?php \$pagetitle = 'Faculty Listing';
require_once('faculty/script/faculty_utilities.php');
echo \$pagetitle;
?>#passthrough-->";
        
    $cascade->createTextBlock(
        $parent_folder,
        'title',
        $code );

    $code = "<div id=\"logo\"></div>";
    
    $cascade->createTextBlock(
        $parent_folder,
        'logo',
        $code );
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