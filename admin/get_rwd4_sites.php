<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $sites = $cascade->getSites();
    $rwd4_sites = array();
    
    foreach( $sites as $site )
    {
        $site_name   = $site->getPathPath();
        // setup block in the base folder
        $setup_block = $admin->getDataDefinitionBlock( "setup", $site_name );
        
        if( is_null( $setup_block )  )
        {
            $rwd4_sites[] = $site_name;
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