<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

// the file to manipulate
$path = "/files/global-editor.css";

// a flag to control the checkIn/checkOut process
$out = false;

try
{
    $id = $service->createId( a\File::TYPE, $path, "cascade-admin" );
         
    if( $out )
    {
        $service->checkOut( $id );
    }
    else
    {
        $service->checkIn( $id, 'Testing the checkIn method.' );
    }
    
    if( $service->isSuccessful() )
    {
        if( $out )
            echo "Successfully checked out the asset.", BR;
        else
            echo "Successfully checked in the asset.", BR;
    }
    else
    {
        if( $out )
            echo "Failed to check out the asset. ",
                $service->getMessage();
        else
            echo "Failed to check in the asset. ", 
                $service->getMessage();
    }
}
catch( \Exception $e )
{
    echo S_PRE, $e, E_PRE;
}
catch( \Error $er )
{
    echo S_PRE, $er, E_PRE;
}
?>