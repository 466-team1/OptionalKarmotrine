<?php

require_once 'db.php';

function addItemToCart(string $item, int $quantity = 1, int $max)
{
    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = [];
    }
    if(isset($_SESSION['cart'][$item]))
    {
        if($_SESSION['cart'][$item] + $quantity <= $max)
        {
            $_SESSION['cart'][$item] += $quantity;
        }
        else
        {
            $_SESSION['cart'][$item] = $max;
        }
    }
    else
    {
        $_SESSION['cart'][$item] = $quantity;
    }
}

function isAvailable(PDO &$pdo, string $item, int $quantity, int &$max): bool
{
    $sql = <<<SQL
    SELECT STOCK FROM DRINKS
    WHERE NAME = ?
    SQL;

    try
    {
        $statement = $pdo->prepare($sql);
        $statement->execute([$item]);
        $result = $statement->fetchColumn();
        $max = $result;
        return ($result >= $quantity);
    }
    catch(PDOException $e)
    {
        echo "Query Failure: " . $e->getMessage();
    }

    return false;
}

function isValidItem(PDO &$pdo, string $item): bool
{
    $sql = <<<SQL
    SELECT COUNT(*) FROM DRINKS
    WHERE NAME = ?
    SQL;

    try
    {
        $statement = $pdo->prepare($sql);
        $statement->execute([$item]);
        $result = $statement->fetchColumn();
        return ($result == 1);
    }
    catch(PDOException $e)
    {
        echo "Query Failure: " . $e->getMessage();
    }

    return false;
}

function updateCartItem(string $item, int $quantity, int $max)
{
    if($quantity == 0)
    {
        if(isset($_SESSION['cart'][$item])) { unset($_SESSION['cart'][$item]); }
    }
    else if($quantity > $max)
    {
        $_SESSION['cart'][$item] = $max;
    }
    else
    {
        $_SESSION['cart'][$item] = $quantity;
    }
}

function getItemPrice(PDO &$pdo, $item) : float
{
    $sql = <<<SQL
    SELECT PRICE FROM DRINKS
    WHERE NAME = ?
    SQL;

    try
    {
        $statement = $pdo->prepare($sql);
        $statement->execute([$item]);
        $result = $statement->fetchColumn();
        return $result;
    }
    catch(PDOException $e)
    {
        echo "Query Failure: " . $e->getMessage();
    }
}

function getCartSubtotal(PDO &$pdo)
{
    $total = 0.00;
    foreach($_SESSION['cart'] as $item => $quantity)
    {
        $total += $quantity * getItemPrice($pdo, $item);
    }

    return $total;
}

function applyPromoCode(string $code): string
{
    switch($code)
    {
        case "FlamingMoai":
        case "Flaming Moai":
            addItemToCart("Flaming Moai");
            $_SESSION['codes'][] = "Flaming Moai";
            break;

        default: return "<p class=\"Adelhyde\">Invalid code</p>";
    }
    return "<p class=\"Flanergide\">Promo Code $code added successfully.</p>";
}

?>
