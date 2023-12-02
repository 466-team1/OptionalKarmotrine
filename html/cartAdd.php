<?php
session_start();
require_once '../lib/library.php';

$max = 0;
if((isset($_POST["DRINK"], $_POST["QTY"])) && isAvailable($pdo, $_POST["DRINK"], $_POST["QTY"], $max))
{
    addItemToCart($_POST['DRINK'], $_POST['QTY'], $max);
}
$location = 'drinks.php';
header("Location: $location", true, 303);
die ("<html><body>Item was added to your cart. <a href=\"$location\">Click here if your are not redirected automatically.</a></body></html>\n");
?>
