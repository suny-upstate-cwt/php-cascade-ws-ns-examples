<?php
/*
This program shows how to disable site destinations contained in the root container.
It also shows how to store information of disabled destinations in a text block.
What is stored is PHP code, and can be used to enable these destinations later.
See enable_rwd4_destinations.php
*/

require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time  = time();
$dest_suffix = "-www";

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    require_once( 'get_rwd4_sites.php' );
    
    $php_code = "\$dest_array=array();";
    $tb = $admin->getAsset( a\TextBlock::TYPE, "2e87c3228b7f08ee33813d003bbd80ec" );
    
    foreach( $rwd4_sites as $site_name )
    {
        $dest_ids = $admin->getSite( $site_name )->
            getRootSiteDestinationContainer()->getChildren();
            
        if( count( $dest_ids ) > 0 )
        {
            foreach( $dest_ids as $dest_id )
            {
                $dest_name = $dest_id->getPathPath();
                
                if( u\StringUtility::endsWith( $dest_name, $dest_suffix ) )
                {
                    $dest = $dest_id->getAsset( $service );
                    
                    if( $dest->getEnabled() === true )
                    {
                        // disable the destination here
                        // $dest->setEnabled( false )->edit();
                        $php_code .= "\$dest_array['$site_name']='$dest_name';";
                    }
                }
            }
        }
    }
    // store the code in a text block
    $tb->setText( $php_code )->edit();
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