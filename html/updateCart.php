<?php

session_start();
require_once '../lib/library.php';
header('Content-Type: application/json; charset=utf-8');

//Safety Checks
if(!isset($_POST['item']))
{
    die(json_encode([
        'status' => 'error',
        'message' => 'item parameter missing'
    ]));
}
if(empty($_POST['item']))
{
    die(json_encode([
        'status' => 'error',
        'message' => 'item parameter empty'
    ]));
}
if(!isset($_POST['quantity']))
{
    die(json_encode([
        'status' => 'error',
        'message' => 'quantity parameter missing'
    ]));
}
if($_POST['quantity'] == '')
{
    die(json_encode([
        'status' => 'error',
        'message' => 'quantity parameter empty'
    ]));
}
if(!is_numeric($_POST['quantity']))
{
    die(json_encode([
        'status' => 'error',
        'message' => 'quantity parameter nonnumeric'
    ]));
}
if(($_POST['quantity']) < 0)
{
    $_POST['quantity'] = 0;
}
if(!isValidItem($pdo, $_POST['item']))
{
    die(json_encode([
        'status' => 'error',
        'message' => "item {$_POST['item']} does not exist"
    ])); 
}
$maxQTY = 0;
if(!isAvailable($pdo, $_POST['item'], $_POST['quantity'], $maxQTY))
{
    echo json_encode([
        'status' => 'error',
        'message' => "item {$_POST['item']} stock too low",
        'item' => $_POST['item'],
        'quantity' => $_POST['quantity'],
        'cart' => $_SESSION['cart'],
        'subtotal' => getCartSubtotal($pdo)
    ]);
}

//Business Logic
updateCartItem($_POST['item'], $_POST['quantity'], $maxQTY);
echo json_encode([
    'status' => 'okay',
    'item' => $_POST['item'],
    'quantity' => $_POST['quantity'],
    'cart' => $_SESSION['cart'],
    'subtotal' => getCartSubtotal($pdo)
]);
//print_r($_SESSION);

?>