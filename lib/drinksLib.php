<?php

require_once 'db.php';

function selectFlavor($pdo, $flavor)
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

function selectType($pdo, $type)
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

function selectCategory($pdo, $category)
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
            $filename = str_replace(' ', '', $row['NAME']);
            $urlName = str_replace(' ', '-', $row['NAME']);

            echo <<<HTML
            <div class="col h-100 card mb-3" style="max-width: 600px;" id="borderCALI">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/drinks/$filename" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title Adelhyde">{$row['NAME']}</h5>
                            <p class="card-text Bronson">{$row['QUOTE']}</p>
                            <div class="row">
                                <span class="badge rounded-pill col-3 text-bg-info fs-6">{$row['FLAVOR']}</span>
                                <span class="badge rounded-pill col-3 text-bg-info fs-6">{$row['TYPE']}</span>
                                <span class="badge rounded-pill col-3 text-bg-info fs-6">{$row['CATEGORY']}</span>
                            </div>
                            <form class="row py-2" action="drinkProfile.php" method="GET">
                                <button type="submit" value=$urlName name="Drink" class="btn btn-val col-5 fs-5">Details</button>
                                <p class="col-3 m-0 fs-3 Karmotrine">\${$row['PRICE']}</p>
                                <p class="col-4 m-0 p-2"><small class="Delta">{$row['STOCK']} stocked</small></p>
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

            echo <<<HTML
            <div class="cartItem">
                <div class="card mb-4" id="borderCALI">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="assets/drinks/$filename.png">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="fw-normal mb-2 fs-5 Adelhyde">{$row['NAME']}</p>
                                <p class="Flanergide">
                                    <span class="Bronson">Flavor: </span>{$row['FLAVOR']} <span class="Bronson">Type: </span>{$row['TYPE']}<br>
                                    <span class="Bronson">Catagory: </span>{$row['CATEGORY']} <span class="Karmotrine">Price: $</span><span class="Karmotrine price">$floatPrice</span>
                                </p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                                    <i class="fas fa-minus Delta"></i>
                                </button>

                                <input id="Item" name="item" value="{$row['NAME']}" type="hidden"/>
                                <input id="Quantity" min="0" max=$row[STOCK] name="quantity" value=$quantity type="number" class="form-control form-control-sm Quantity"/>
            
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                                    <i class="fas fa-plus Delta"></i>
                                </button>
                            </div>
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

?>
