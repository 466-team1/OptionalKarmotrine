
<html><head><title>Order Details</title></head></html>

<?php
try { // if something goes wrong, an exception is thrown
$dsn = "mysql:host=courses;dbname=z1922762";
$pdo = new PDO($dsn, "z1922762", "2003May20");
// Order Number
$on = $_GET["ordernum"];


echo "<h1>Customer order details for: $on</h1>";

$cmd = "SELECT * FROM ORDERS WHERE ORDER_NUM=?";
$stmt = $pdo->prepare($cmd);
$stmt->execute([$on]);
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
echo "<td>Cost</td>";
echo "<td>Customer Name</td>";
echo "<td>Customer Address</td>";
echo "<td>Customer eMail</td>";
echo "<td>Status</td>";
echo "<td>Note</td>";
echo "<td>Tracking</td>";
echo "</tr>";

$order = $pdo->query("SELECT * FROM ORDERS WHERE ORDER_NUM = '$on';");
$rows = $order->fetchAll(PDO::FETCH_ASSOC);

// Table data
foreach($rows as $row){
    echo "<tr>";
    echo "<td>", $row["ORDER_NUM"], "</td><td>", $row["COST"], "</td><td>", $row["CUS_NAME"], "</td><td>", $row["CUS_ADDRESS"], "</td><td>", $row["CUS_EMAIL"], "</td><td>", $row["STATUS"], "</td><td>", $row["NOTE"], "</td><td>", $row["TRACKING"], "</td>";
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