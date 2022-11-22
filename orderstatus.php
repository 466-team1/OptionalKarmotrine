
<html><head><title>Order Status</title></head></html>

<?php
try { // if something goes wrong, an exception is thrown
$dsn = "mysql:host=courses;dbname=z1922762";
$pdo = new PDO($dsn, "z1922762", "2003May20");
// Order number and order status
$on = $_POST["ordernum"];
$os = $_POST["status"];

echo "<h1>Customer order status for: $on</h1>";

$cmd = "SELECT * FROM ORDERS WHERE ORDER_NUM=?";
$stmt = $pdo->prepare($cmd);
$stmt->execute([$on]);
$gt = $stmt->fetch();
if($gt)
{
    echo"<br>";
    print("Updated order $on status to $os");

}
else
{
    echo "Order not found!";
    echo "<br>";

    echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Back to admin page</button>";
    exit();
}

$sql = "UPDATE ORDERS SET STATUS = :STATUS WHERE ORDER_NUM = :ORDER";
$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$success = $prepared->execute(array(':STATUS' => $os, ':ORDER' => $on));


$order = $pdo->query("SELECT * FROM ORDERS WHERE ORDER_NUM = '$on';");
$rows = $order->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Customer Orders & Drink Inventory</h2>";
// Column titles
echo "<h3>Customer Order(s)</h3>";
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