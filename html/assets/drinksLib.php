<?php

$username = 'z1951125';
$password = '2000Mar30';

function printQuote()
{
    return "\"It's like drinking ethylic alcohol with a spoonful of sugar.\"";
}

function selectFlavor($pdo, $flavor)
{
    try
    {
        $result = $pdo->query("SELECT * FROM DRINKS WHERE CATEGORY != 'Secret' AND FLAVOR = '$flavor';");
    }
    catch(PDOexception $e)
    {
    echo "Query Failure: " . $e->getMessage();
    }

    if(empty($result)) { echo "<p>No results found.</p>"; }
    else
    {
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        drawCards($rows);
    }
}

function selectType($pdo, $type)
{
    try
    {
        $result = $pdo->query("SELECT * FROM DRINKS WHERE CATEGORY != 'Secret' AND TYPE = '$type';");
    }
    catch(PDOexception $e)
    {
    echo "Query Failure: " . $e->getMessage();
    }

    if(empty($result)) { echo "<p>No results found.</p>"; }
    else
    {
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        drawCards($rows);
    }
}

function selectCategory($pdo, $category)
{
    try
    {
        $result = $pdo->query("SELECT * FROM DRINKS WHERE CATEGORY = '$category';");
    }
    catch(PDOexception $e)
    {
    echo "Query Failure: " . $e->getMessage();
    }

    if(empty($result)) { echo "<p>No results found.</p>"; }
    else
    {
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
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
            $quote = printQuote();
            $fileName = str_replace(' ', '', $row['NAME']);

            echo "<div class=\"col h-100 card mb-3\" style=\"max-width: 600px;\" id=\"borderCALI\">";
            echo "<div class=\"row g-0\"><div class=\"col-md-4\">";
            echo "<img src=\"assets/drinks/$fileName\" class=\"img-fluid rounded-start\"></div>";
            echo "<div class=\"col-md-8\"><div class=\"card-body\">";
            echo "<h5 class=\"card-title Adelhyde\">$row[NAME]</h5>";
            echo "<p class=\"card-text Bronson\">$quote</p><div class=\"row\">";
            echo "<span class=\"badge rounded-pill col-3 text-bg-info fs-6\">$row[FLAVOR]</span>";
            echo "<span class=\"badge rounded-pill col-3 text-bg-info fs-6\">$row[TYPE]</span>";
            echo "<span class=\"badge rounded-pill col-3 text-bg-info fs-6\">$row[CATEGORY]</span></div>";
            echo "<div class=\"row py-2\"><a href=\"https://students.cs.niu.edu/~z1951125/OptionalKarmotrine/html/FringeWeaver\" class=\"btn btn-val col-5 fs-5\">Details</a>";
            echo "<p class=\"col-3 m-0 fs-3 Karmotrine\">$$row[PRICE]</p><p class=\"col-4 m-0 p-2\"><small class=\"Delta\">$row[STOCK] stocked</small></p>";
            echo "</div></div></div></div></div>";
        }
        echo "</div>";
    }
}

?>
