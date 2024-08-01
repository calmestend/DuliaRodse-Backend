<?php

defined("SITE_ROOT")
    ? null
    : define("SITE_ROOT", "/var/www/duliarodse.com/duliarodse/back");

defined("INCLUDE_PATH")
    ? null
    : define("INCLUDE_PATH", SITE_ROOT . DIRECTORY_SEPARATOR . "includes");

defined("CORE_PATH")
    ? null
    : define("CORE_PATH", SITE_ROOT . DIRECTORY_SEPARATOR . "core");

include_once INCLUDE_PATH . DIRECTORY_SEPARATOR . "config.php";
include_once CORE_PATH . DIRECTORY_SEPARATOR . "post.php";

?>

