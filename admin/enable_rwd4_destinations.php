<?php
/*
This program is the counterpart of disable_rwd4_destinations.
PHP code stored in a text block is read and executed to restored
disabled destinations.
*/

require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    $tb = $admin->getAsset( a\TextBlock::TYPE, "2e87c3228b7f08ee33813d003bbd80ec" );
    $php_code = $tb->getText();
    eval( $php_code );
    
    foreach( $dest_array as $site_name => $dest_name )
    {
        $dest = $admin->getAsset( a\Destination::TYPE, $dest_name, $site_name );
        $dest->setEnabled( true )->edit();
        u\DebugUtility::out( $site_name . ", " . $dest->getPath() );
    }

    u\DebugUtility::outputDuration( $start_time );
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