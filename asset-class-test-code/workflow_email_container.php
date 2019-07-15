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
    $id = "dcee71f28b7ffea932e15180ae5fe835"; // Test
    $wec = $cascade->getAsset( a\WorkflowEmailContainer::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $wec->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $wec->dump();
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $wec->getId() . BR .
                 "Name: " . $wec->getName() . BR .
                 "Path: " . $wec->getPath() . BR .
                 "Property name: " . $wec->getPropertyName() . BR .
                 "Site name: " . $wec->getSiteName() . BR .
                 "Type: " . $wec->getType() . BR .
                 "";
                 
            $children = $wec->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            u\DebugUtility::dump( $wec->getContainerChildrenIds() );
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $wec_std = $service->retrieve( 
                $service->createId( 
                    c\T::WORKFLOWEMAILCONTAINER, $id ), 
                    c\P::WORKFLOWEMAILCONTAINER );
            
            u\DebugUtility::dump( $wec_std );
            
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\WorkflowEmailContainer" );
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