
<html><head><title>Drink Inventory</title></head></html>

<?php
try { // if something goes wrong, an exception is thrown
$dsn = "mysql:host=courses;dbname=z1922762";
$pdo = new PDO($dsn, "z1922762", "2003May20");

$order = $pdo->query("SELECT * FROM DRINKS;");
$rows = $order->fetchAll(PDO::FETCH_ASSOC);

// Column titles
echo "<h1>Drink Inventory</h1>";

echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Back to admin page</button>";
echo "<br><br>";
echo "<table border=1 cellspacing=2>";
echo "<tr>";
echo "<td>Name</td>";
echo "<td>Stock</td>";
echo "</tr>";

// Table data
foreach($rows as $row){
    echo "<tr>";
    echo "<td>", $row["NAME"], "</td><td>", $row["STOCK"], "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<br>";
}

catch(PDOexception $e) { // handle exception
echo "Connection to database failed: " . $e->getMessage();
}
?>