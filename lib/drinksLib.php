<?php

function printQuote($filename)
{
    switch ($filename)
    {
        case 'BadTouch':
            return "\"We're nothing but mammals after all.\"";
            break;
        
        case 'Beer':
            return "\"Traditionally brewed beer has become a luxury, but this one's pretty close to the real deal...\"";
            break;

        case 'BleedingJane':
            return "\"Say the name of this drink three times in front of a mirror and you'll look like a fool.\"";
            break;

        case 'BloomLight':
            return "\"It's so unnecessarily brown....\"";
            break;

        case 'BlueFairy':
            return "\"One of these will make all your teeth turn blue. Hope you brushed them well.\"";
            break;

        case 'Brandtini':
            return "\"8 out of 10 smug assholes would recommend it but they're too busy being smug assholes.\"";
            break;

        case 'CobaltVelvet':
            return "\"It's like champaigne served in a cup that had a bit of cola left.\"";
            break;
            
        case 'CreviceSpike':
            return "\"It will knock the drunkenness out of you or knock you out cold.\"";
            break;

        case 'FlamingMoai':
            return "\"The golden ratio does infact apply to synthetic alcohol substitutes.\"";
            break;

        case 'FluffyDream':
            return "\"A couple of these will make your tongue feel velvet-y. More of them and you'll be sleeping soundly.\"";
            break;

        case 'FringeWeaver':
            return "\"It's like drinking ethylic alcohol with a spoonful of sugar.\"";
            break;

        case 'FrothyWater':
            return "\"PG-rated shows' favorite Beer ersatz since 2040.\"";
            break;

        case 'GrizzlyTemple':
            return "\"This one's kinda unbearable. It's mostly for fans of the movie it was used in.\"";
            break;

        case 'GutPunch':
            return "\"It's supposed to mean \"a punch made of innards\", but the name actually described what you feel while drinking it.\"";
            break;
          
        case 'Marsblast':
            return "\"One of these is enough to leave your face red like the actual planet.\"";
            break;

        case 'Mercuryblast':
            return "\"No thermometer was harmed in the creation of this drink.\"";
            break;

        case 'Moonblast':
            return "\"No relation to the Hadron cannon you can see on the moon for one week every month.\"";
            break;

        case 'PianoMan':
            return "\"This drink does not represent the opinions of the Bar Pianists Union or its associates.\"";
            break;

        case 'PianoWoman':
            return "\"It was originally called Pretty Woman, but too many people complained there should be a Piano Woman if there was a Piano Man.\"";
            break;

        case 'PileDriver':
            return "\"It doesn't burn as hard on the tongue but you better not have a sore throat when drinking it...\"";
            break;
                                        
        case 'SparkleStar':
            return "\"They used to actually sparkle, but too many complaints about skin problems made them redesign the drink without sparkling.\"";
            break;

        case 'SugarRush':
            return "\"Sweet, light and fruity. As girly as it gets.\"";
            break;

        case 'SunshineCloud':
            return "\"Tastes like old chocolate milk with its good smell intact. Some say it tastes like caramel too...\"";
            break;

        case 'Suplex':
            return "\"A small twist on the Piledriver, putting more emphasis on the tongue burning and less on the throat burning.\"";
            break;

        case 'ZenStar':
            return "\"You'd think something so balanced would actually taste nice... you'd be dead wrong.\"";
            break;

        default:
            return "How did you even get here? Is this my base layer?";
            break;
    }
}

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
    catch(PDOException $e)
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
    catch(PDOException $e)
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
            
            $filename = str_replace(' ', '', $row['NAME']);
            $urlName = str_replace(' ', '-', $row['NAME']);
            $quote = printQuote($filename);

            echo "<div class=\"col h-100 card mb-3\" style=\"max-width: 600px;\" id=\"borderCALI\">";
            echo "<div class=\"row g-0\"><div class=\"col-md-4\">";
            echo "<img src=\"assets/drinks/$filename\" class=\"img-fluid rounded-start\"></div>";
            echo "<div class=\"col-md-8\"><div class=\"card-body\">";
            echo "<h5 class=\"card-title Adelhyde\">$row[NAME]</h5>";
            echo "<p class=\"card-text Bronson\">$quote</p><div class=\"row\">";
            echo "<span class=\"badge rounded-pill col-3 text-bg-info fs-6\">$row[FLAVOR]</span>";
            echo "<span class=\"badge rounded-pill col-3 text-bg-info fs-6\">$row[TYPE]</span>";
            echo "<span class=\"badge rounded-pill col-3 text-bg-info fs-6\">$row[CATEGORY]</span></div>";
            echo "<form class=\"row py-2\" action=\"https://students.cs.niu.edu/~z1925422/OptionalKarmotrine/html/drinkProfile.php\" method=\"GET\"><button type=\"submit\" value=$urlName name=\"Drink\" class=\"btn btn-val col-5 fs-5\">Details</button>";
            echo "<p class=\"col-3 m-0 fs-3 Karmotrine\">$$row[PRICE]</p><p class=\"col-4 m-0 p-2\"><small class=\"Delta\">$row[STOCK] stocked</small></p>";
            echo "</form></div></div></div></div>";
        }
        echo "</div>";
    }
}

?>
