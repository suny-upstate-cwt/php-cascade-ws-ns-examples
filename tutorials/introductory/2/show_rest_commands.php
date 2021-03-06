<?php
require_once( 'auth_rest_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $block = $admin->getAsset( a\TextBlock::TYPE, "7cd5a023ac1e001b5dd3d5e8ed91990c" );
    u\DebugUtility::dump( $service->getCommands() );
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