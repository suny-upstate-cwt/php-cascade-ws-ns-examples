<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$wfd_id  = "bf0b27478b7ffe83129f37d447c71af6";
$page_id = "94547c688b7ffe8347b1526e6077be06";

try
{
    $page = $admin->getAsset( a\Page::TYPE, $page_id )->
        edit( NULL,
            $admin->getAsset( a\WorkflowDefinition::TYPE, $wfd_id ),
            "Dummy",
            "Testing the dummy workflow def with comments"
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