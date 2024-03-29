<?php

require_once 'db.php';
require_once 'library.php';

function selectFlavor(&$pdo, $flavor)
{
    try
    {
        $result = $pdo->query("SELECT * FROM DRINKS WHERE CATEGORY != 'Secret' AND FLAVOR = '$flavor';");
    }
    catch(PDOException $e)
    {
    echo "Query Failure: " . $e->getMessage();
    }

    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    if(empty($rows)) { echo "<p>No results found.</p>"; }
    else
    {
      drawCards($rows);
    }
}

function selectType(&$pdo, $type)
{
    try
    {
        $result = $pdo->query("SELECT * FROM DRINKS WHERE CATEGORY != 'Secret' AND TYPE = '$type';");
    }
    catch(PDOException $e)
    {
    echo "Query Failure: " . $e->getMessage();
    }

    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    if(empty($rows)) { echo "<p>No results found.</p>"; }
    else
    {
      drawCards($rows);
    }
}

function selectCategory(&$pdo, $category)
{
    try
    {
        $result = $pdo->query("SELECT * FROM DRINKS WHERE CATEGORY = '$category';");
    }
    catch(PDOException $e)
    {
        echo "Query Failure: " . $e->getMessage();
    }

    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    if(empty($rows)) { echo "<p>No results found.</p>"; }
    else
    {
        drawCards($rows);
    }
}

function drawCards($rows)
{
    if(empty($rows)) { echo "<p>No results found.</p>"; }
    else 
    {
        echo "<div class=\"row row-cols-1 row-cols-md-3 g-4\">";
        foreach($rows as $row)
        {
            $filename = str_replace(' ', '', $row['NAME']) . ".png";
            $urlName = str_replace(' ', '-', $row['NAME']);

            echo <<<HTML
            <div class="col h-100 card mb-3" style="max-width: 600px;" id="borderCALI">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/drinks/$filename" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="fw-bold Adelhyde">{$row['NAME']}</h5>
                            <p class="card-text Bronson">{$row['QUOTE']}</p>
                            <div class="row">
                                <span class="badge rounded-pill col-4 text-bg-info fs-6">{$row['FLAVOR']}</span>
                                <span class="badge rounded-pill col-4 text-bg-info fs-6">{$row['TYPE']}</span>
                                <span class="badge rounded-pill col-4 text-bg-info fs-6">{$row['CATEGORY']}</span>
                            </div>
                            <form class="row py-2" action="drinkProfile.php" method="GET">
                                <button type="submit" value=$urlName name="Drink" class="btn btn-val col-5 fw-bold fs-5" style="white-space:nowrap;">Details</button>
                                <p class="col-3 m-0 fs-3 Karmotrine" style="white-space:nowrap;">\${$row['PRICE']}</p>
                                <p class="col-4 m-0 p-2"><small class="Delta" style="white-space:nowrap;">Stock: {$row['STOCK']}</small></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            HTML;
        }
        echo "</div>";
    }
}

function drawCartItem(PDO &$pdo, $item, $quantity)
{
    $sql = <<<SQL
    SELECT * FROM DRINKS
    WHERE NAME = ?
    SQL;

    try
    {   
        $statement = $pdo->prepare($sql);
        $statement->execute([$item]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        echo "Query Failure: " . $e->getMessage();
    }

    if(empty($rows)) { echo "<p>No results found.</p>"; }
    else 
    {
        foreach($rows as $row)
        {
            $filename = str_replace(' ', '', $row['NAME']);
            $urlName = str_replace(' ', '-', $row['NAME']);
            $floatPrice = number_format((float)$row['PRICE'], 2, '.', '');
            $adjustedPrice = number_format((float)($quantity * $floatPrice), 2, '.', '');
            if($quantity > $row['STOCK']) { $quantity = $row['STOCK']; }

            echo <<<HTML
            <div class="cartItem">
                <div class="card mb-4" id="borderCALI">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="assets/drinks/$filename.png">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <a href="drinkProfile.php?Drink={$urlName}" class="fw-normal mb-2 fs-5 Adelhyde">{$row['NAME']}</a>
                                <p class="Flanergide">
                                    <span class="Bronson">Flavor: </span>{$row['FLAVOR']} <span class="Bronson">Type: </span>{$row['TYPE']}<br>
                                    <span class="Bronson">Catagory: </span>{$row['CATEGORY']} <span class="Karmotrine">Price: $</span><span class="Karmotrine price">$floatPrice</span><br>
                                    <span class="Delta">Stock: </span>{$row['STOCK']}
                                </p>
                            </div>
                            <form class="col-md-3 col-lg-3 col-xl-2 d-flex" action="javascript:void(0);">
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                                    <i class="fas fa-minus Delta"></i>
                                </button>

                                <input id="Item" name="item" value="{$row['NAME']}" type="hidden">
                                <input class="form-control Quantity" id="Quantity" min="0" max="{$row['STOCK']}" name="quantity" value=$quantity type="number">
            
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                                    <i class="fas fa-plus Delta"></i>
                                </button>
                            </form>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1"><h2 class="mb-0 Karmotrine cost">$$adjustedPrice</h2></div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <button class="btn btn-link px-2" onclick="removeCart(this, '{$row['NAME']}')">
                                    <i class="fas fa-trash fa-lg Stella"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            HTML;
        }
    }
}

function drawCart(PDO &$pdo)
{
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as $item => $quantity)
        {
            drawCartItem($pdo, $item, $quantity);
        }
    }
    else 
    {
        echo "<h2 class=\"px-4\">Your cart is empty.</h2>";
    }
}

function drawCheckoutItem(PDO &$pdo, $item, $quantity)
{
    $sql = <<<SQL
    SELECT * FROM DRINKS
    WHERE NAME = ?
    SQL;

    try
    {   
        $statement = $pdo->prepare($sql);
        $statement->execute([$item]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        echo "Query Failure: " . $e->getMessage();
    }

    if(empty($rows)) { echo "<p>No results found.</p>"; }
    else 
    {
        foreach($rows as $row)
        {
            $filename = str_replace(' ', '', $row['NAME']);
            $floatPrice = number_format((float)$row['PRICE'], 2, '.', '');
            $adjustedPrice = number_format((float)($quantity * $floatPrice), 2, '.', '');

            echo <<<HTML
            <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0 Adelhyde">{$row['NAME']}</h6>
              <small class="Bronson">Quantity: $quantity</small>
            </div>
            <img src="assets/drinks/$filename.png" width="50px" height="60">
            <span class="Karmotrine fs-4">\$$adjustedPrice</span>
            </li><hr>
            HTML;
        }   
    }
}

function drawCheckout(PDO &$pdo)
{ 
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
    {
        echo "<ul class=\"list-group mb-3\">";
        foreach($_SESSION['cart'] as $item => $quantity)
        {
            drawCheckoutItem($pdo, $item, $quantity);
        }
        $total = number_format((float)getCartSubtotal($pdo), 2, '.', '');
        echo "</ul>";
        echo "<li class=\"list-group-item d-flex justify-content-between\">";
        echo "<span class=\"Adelhyde fs-3\">Total:</span>";
        echo "<span class=\"Karmotrine fs-3\">\$$total</span></li>";
    }
    else 
    {
        echo "<h2 class=\"px-2\">Your cart is empty.</h2>";
    }
}

function drawOrder(PDO &$pdo): bool
{
    $sql = <<<SQL
    SELECT * FROM ORDERS
    WHERE ORDER_NUM = ?
    SQL;

    try
    {   
        $statement = $pdo->prepare($sql);
        $statement->execute([$_POST['ordernum']]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        echo "Query Failure: " . $e->getMessage();
    }

    if(empty($rows))
    { 
        echo "<p class=\"text-center Adelhyde\">Order not found.</p><img class=\"d-block mx-auto mb-2\" src=\"assets/drinks/ERROR.png\" id=\"borderCALI\">";
        return false;
    }
    else 
    {
        foreach($rows as $row)
        {
            echo <<<HTML
            <div class="p-2 m-2">
              <h2>Order#{$row['ORDER_NUM']}</h2><span class="Adelhyde fs-5">Email: {$row['CUS_EMAIL']}</span>
              <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0 Bronson fs-5">{$row['CUS_NAME']}</h6>
                <small class="Flanergide fs-5">Address: {$row['CUS_ADDRESS']}</small>
              </div>
              <div>
                <h6 class="my-0 Flanergide fs-5"><a href="#">Tracking #{$row['TRACKING']}</a></h6>
                <small class="Delta fs-5">Order Status: {$row['STATUS']}</small>
              </div>
              <h2 class="Karmotrine">Order Total:\${$row['COST']}</h2>
              </li><hr>
            </div>
            HTML;
        }

        $sql = <<<SQL
        SELECT * FROM HAS
        JOIN DRINKS USING (NAME)
        WHERE ORDER_NUM = ?
        SQL;

        try
        {   
            $statement = $pdo->prepare($sql);
            $statement->execute([$_POST['ordernum']]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo "Query Failure: " . $e->getMessage();
        }

        if(empty($rows)) { echo "<p>No drinks found in order.</p>"; }
        else 
        {   echo"<div id=\"borderTECH\">";
            echo "<h2 class = \"p-2 m-2\">Order Contents</h2>";
            foreach($rows as $row)
            {
                $floatPrice = number_format((float)$row['PRICE'], 2, '.', '');
                $adjustedPrice = number_format((float)($row['QTY'] * $floatPrice), 2, '.', '');
                $filename = str_replace(' ', '', $row['NAME']);
                echo <<<HTML
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="col-2 p-3 m-3">
                    <img src="assets/drinks/$filename" class="img-fluid rounded-start" id="borderCALI">
                  </div>
                  <div class="col-4">
                    <p class="Adelhyde fs-4">{$row['NAME']}</p>
                    <p class="Flanergide">
                      <span class="Bronson">Flavor: </span>{$row['FLAVOR']} <span class="Bronson">Type: </span>{$row['TYPE']}<br>
                      <span class="Bronson">Catagory: </span>{$row['CATEGORY']} <span class="Karmotrine">Price: \$$floatPrice</span><br>
                    </p>
                  </div>
                  <div class="col-2">
                    <h2 class="Delta">Quantity:{$row['QTY']}</h2>
                  </div>
                  <div class="col-2">
                    <h2 class="Karmotrine">\$$adjustedPrice</h2>
                  </div>
                </div>
                HTML;
            }
            echo "</div>";
        }
    }
    return true;
}

?>
