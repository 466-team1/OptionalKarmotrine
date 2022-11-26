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

function applyPromoCode(PDO $pdo, string $code): string
{
    switch($code)
    {
        case "FlamingMoai":
        case "Flaming Moai":
            $max = 0;
            if(isAvailable($pdo, "Flaming Moai", 1, $max))
            {
                addItemToCart("Flaming Moai", 1, $max);
                $_SESSION['codes']["Flaming Moai"] = "Flaming Moai";
            }
            else
            {
                return "<p class=\"Adelhyde\">Not enough stock available, sorry.</p>";
            }
            break;

        default: return "<p class=\"Adelhyde\">Invalid code</p>";
    }
    return "<p class=\"Flanergide\">Promo Code $code added successfully.</p>";
}

function submitOrder($pdo, $cusName, $email, $address): int
{
    $pdo->beginTransaction();
    $cost = getCartSubtotal($pdo);
    $tracking = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);

    //add order to orders table
    $sql = <<<SQL
        INSERT INTO `ORDERS`(`COST`, `CUS_NAME`, `CUS_ADDRESS`, `CUS_EMAIL`, `STATUS`, `NOTE`, `TRACKING`)
        VALUES
        (:COST, :CUS_NAME, :CUS_ADDRESS, :CUS_EMAIL, :STATUS, :NOTE, :TRACKING);
    SQL;
          
    try
    {
        $statement = $pdo->prepare($sql);
    }
    catch(PDOexception $e)
    {
    echo "Prepare Failure: " . $e->getMessage();
    }
    if(!$statement) { die("Error in prepare."); $pdo->rollBack(); }

    try
    {
        $result = $statement->execute([
            ':COST' => $cost,
            ':CUS_NAME' =>  $cusName,
            ':CUS_ADDRESS' => $address, 
            ':CUS_EMAIL' => $email,
            ':STATUS' => "PROCESSING", 
            ':NOTE' => "N/A",
            ':TRACKING' => $tracking 
        ]);
    }
    catch(PDOexception $e)
    {
        echo "Execute Failure: " . $e->getMessage();
    }
    if(!$result) { die("Error in query."); $pdo->rollBack(); }

    //add drinks to has table
    $ORDER_NUM = $pdo->lastInsertId();

    foreach($_SESSION['cart'] as $item => $quantity)
    {
        $sql = <<<SQL
            INSERT INTO `HAS`(`ORDER_NUM`, `NAME`, `QTY`)
            VALUES
            (:ORDER_NUM, :NAME, :QTY);
        SQL;
            
        try
        {
            $statement = $pdo->prepare($sql);
        }
        catch(PDOexception $e)
        {
        echo "Prepare Failure: " . $e->getMessage();
        }
        if(!$statement) { die("Error in prepare."); $pdo->rollBack(); }

        try
        {
            $result = $statement->execute([
                ':ORDER_NUM' => $ORDER_NUM,
                ':NAME' =>  $item,
                ':QTY' => $quantity
            ]);
        }
        catch(PDOexception $e)
        {
            echo "Execute Failure: " . $e->getMessage();
        }
        if(!$result) { die("Error in query."); $pdo->rollBack(); }

        //reduce stock of drink
        $sql = <<<SQL
            UPDATE DRINKS
            SET STOCK = STOCK - :STOCK
            WHERE NAME = :NAME;
        SQL;
            
        try
        {
            $statement = $pdo->prepare($sql);
        }
        catch(PDOexception $e)
        {
        echo "Prepare Failure: " . $e->getMessage();
        }
        if(!$statement) { die("Error in prepare."); $pdo->rollBack(); }

        try
        {
            $result = $statement->execute([
                ':STOCK' => $quantity,
                ':NAME' =>  $item,
            ]);
        }
        catch(PDOexception $e)
        {
            echo "Execute Failure: " . $e->getMessage();
        }
        if(!$result) { die("Error in query."); $pdo->rollBack(); }
    }
    unset($_SESSION['cart']);
    unset($_SESSION['codes']);

    $pdo->commit();
    return $ORDER_NUM;
}

?>
