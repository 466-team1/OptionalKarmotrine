
<html><head><title>Order Contents</title></head></html>

<?php
try { // if something goes wrong, an exception is thrown
$dsn = "mysql:host=courses;dbname=z1922762";
$pdo = new PDO($dsn, "z1922762", "2003May20");
// Order Number
$oc = $_GET["contents"];


echo "<h1>Customer order contents for: $oc</h1>";

$cmd = "SELECT * FROM ORDERS WHERE ORDER_NUM=?";
$stmt = $pdo->prepare($cmd);
$stmt->execute([$oc]);
$gt = $stmt->fetch();
if($gt)
{
    echo"<br>";
    
}
else
{
    echo "Order not found!";
    echo "<br>";

    echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Back to admin page</button>";
    exit();
}

echo "<h3>Customer Order(s)</h3>";
// Column titles
echo "<table border=1 cellspacing=2>";
echo "<tr>";
echo "<td>Order Number</td>";
echo "<td>Name</td>";
echo "<td>QTY</td>";
echo "</tr>";

$order = $pdo->query("SELECT * FROM HAS WHERE ORDER_NUM = '$oc';");
$rows = $order->fetchAll(PDO::FETCH_ASSOC);

// Table data
foreach($rows as $row){
    echo "<tr>";
    echo "<td>", $row["ORDER_NUM"], "</td><td>", $row["NAME"], "</td><td>", $row["QTY"], "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<br>";

echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Back to admin page</button>";
}

catch(PDOexception $e) { // handle exception
echo "Connection to database failed: " . $e->getMessage();
}
?>