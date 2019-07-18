<?php
// roles on sandbox
if( isset( $sandbox ) && $sandbox )
{
    $global_role_id = 10;
    $site_role_id   = 230;
}
// roles on production
else
{
    $global_role_id = 10;
    $site_role_id   = 50;
}

$new_global_role_name = "Test WS Global Role";
$new_site_role_name   = "Test WS Site Role";
?>