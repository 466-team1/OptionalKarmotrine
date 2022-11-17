<?php

$username = 'z1951125';
$password = '2000Mar30';

function draw_table($rows){
  echo "<table border=1 cellspacing=1>";
  echo "<tr>";
  foreach($rows[0] as $key => $item ){
    echo "<th>$key</th>";
  }
  echo "</tr>";
  foreach($rows as $row){
    echo "<tr>";
    foreach($row as $key => $item){
      echo "<td><a href=\"#\">$item</a></td>";
    }
    echo "</tr>";
  }
  echo "</table>";
}?>

<?php
function drawTable($rows)
{
    if(empty($rows)) { echo "<p>No results found.</p>"; }
    else 
    {
        echo "<table class=\"table table-sm table-bordered table-dark table-striped table-hover\">";
        echo "<thead><tr>";
        foreach($rows[0] as $key => $value)
        {
            echo "<th>$key</th>";
        }
        echo "</tr></thead><tbody class=\"table-group-divider\">";
        foreach($rows as $row)
        {
            echo "<tr>";
            foreach($row as $key => $value)
            {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
}

function selectType($pdo, $type)
{
    try
    {
        $result = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' AND TYPE = '$type';");
    }
    catch(PDOexception $e)
    {
    echo "Query Failure: " . $e->getMessage();
    }

    if(empty($result)) { echo "<p>No results found.</p>"; }
    else
    {
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
    }
}

function selectFlavor($pdo, $flavor)
{
    try
    {
        $result = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' AND FLAVOR = '$flavor';");
    }
    catch(PDOexception $e)
    {
    echo "Query Failure: " . $e->getMessage();
    }

    if(empty($result)) { echo "<p>No results found.</p>"; }
    else
    {
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
    }
}

