<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'raw';

try
{
    $id = "e1779d988b7ffea91794b56ab5790e57"; // Test
    $wfe = $cascade->getAsset( a\WorkflowEmail::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $wfe->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $wfe->dump();
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $wfe->getId() . BR .
                 "Name: " . $wfe->getName() . BR .
                 "Path: " . $wfe->getPath() . BR .
                 "Property name: " . $wfe->getPropertyName() . BR .
                 "Site name: " . $wfe->getSiteName() . BR .
                 "Subject: " . $wfe->getSubject() . BR .
                 "Body: " . $wfe->getBody() . BR .
                 "Type: " . $wfe->getType() . BR .
                 "";
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $wfe_std = $service->retrieve( 
                $service->createId( 
                    c\T::WORKFLOWEMAIL, $id ), 
                    c\P::WORKFLOWEMAIL );
            
            u\DebugUtility::dump( $wfe_std );
            
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\WorkflowEmail" );
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