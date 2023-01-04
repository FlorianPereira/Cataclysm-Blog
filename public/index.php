<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../app/autoloader.php';
app\autoloader::register();

/**
 * 'p' is a parameter used for navigating through the website
 * 'p' is set to 'home.php' by default
 */
if(isset($_GET['p'])){
    $p = $_GET['p'];
} else {
    $p = 'home';
}

/**
 * Calls home.php when requested via GET method, or single.php, depending on parameter p
 *
 */
ob_start();
if ($p === 'home') {
    require '../pages/home.php';
} elseif ($p === 'article') {
    require '../pages/single.php';
}

/**
 * Inject .php pages into default.php
 */
$content = ob_get_clean();
require '../pages/templates/default.php'

?>
