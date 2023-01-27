<?php
session_start();
require_once '../lib/library.php';

$max = 0;
if((isset($_POST["DRINK"], $_POST["QTY"])) && isAvailable($pdo, $_POST["DRINK"], $_POST["QTY"], $max))
{
    addItemToCart($_POST['DRINK'], $_POST['QTY'], $max);
}
$location = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/drinks.php';
header("Location: $location", true, 303);
die ("<html><body>Item was added to your cart. <a href=\"$location\">Click here if your are not redirected automatically.</a></body></html>\n");
?>
