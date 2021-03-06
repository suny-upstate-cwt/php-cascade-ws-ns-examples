<?php 
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $audits = $cascade->getAudits(
        $cascade->getAsset( a\Page::TYPE, '96f6e5138b7f0856002a5e11fa547b61' ),
        c\T::EDIT );
        
    foreach( $audits as $audit )
        u\DebugUtility::dump( $audit->toStdClass() );
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