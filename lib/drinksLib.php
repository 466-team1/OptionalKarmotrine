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

?>
