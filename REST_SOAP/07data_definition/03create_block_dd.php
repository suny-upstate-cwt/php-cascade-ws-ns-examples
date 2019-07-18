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
    $site_name = "cancer-test";
    $ddc_name  = "Test DD Container";
    $dd_name   = "WYSIWYG";
    
    $dd = $admin->getDataDefinition( "$ddc_name/$dd_name", $site_name );
    
    if( isset( $dd ) )
    {
        $admin->deleteAsset( $dd );
    }
    
        $xml = '
<system-data-structure>
    <text default="yes" help-text="Select yes to display" identifier="display" label="Display" required="true" type="radiobutton">
        <radio-item value="yes"/>
        <radio-item value="no"/>
    </text>
    <!-- wysiwyg -->
    <group identifier="wysiwyg-group" label="Wysiwyg Group">
        <text identifier="wysiwyg-content" label="Content" wysiwyg="true"/>
    </group>
</system-data-structure>';
    
    $dd = $admin->createDataDefinition(
        $admin->getAsset( a\DataDefinitionContainer::TYPE, $ddc_name, $site_name ),
        $dd_name,
        $xml
    )->dump();
    
    if( $service->isRest() )
    {
        u\DebugUtility::dumpRESTCommands( $service );
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