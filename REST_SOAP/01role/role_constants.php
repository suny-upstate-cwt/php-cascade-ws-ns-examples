<?php
// roles on sandbox
if( isset( $sandbox ) && $sandbox )
{
    $site_role_id   = 10;
    $global_role_id = 30;
}
// roles on production
else
{
    $site_role_id   = 5;
    $global_role_id = 131;
}

$new_global_role_name = "Test WS Global Role";
$new_site_role_name   = "Test WS Site Role";
?>