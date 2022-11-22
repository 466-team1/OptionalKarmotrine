
<html><head><title>Order Note</title></head></html>

<?php
try { // if something goes wrong, an exception is thrown
$dsn = "mysql:host=courses;dbname=z1922762";
$pdo = new PDO($dsn, "z1922762", "2003May20");
// Order number and note
$on = $_POST["ordernum"];
$n = $_POST["note"];

echo "<h1>Customer order note for: $on</h1>";

$cmd = "SELECT * FROM ORDERS WHERE ORDER_NUM=?";
$stmt = $pdo->prepare($cmd);
$stmt->execute([$on]);
$gt = $stmt->fetch();
if($gt)
{
    echo"<br>";
    print("Updated order $on");
    echo "<br>";
    echo "Note: ";
    echo $n;
    echo "<br>";

}
else
{
    echo "Order not found!";
    echo "<br>";
    
    echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Back to admin page</button>";
    exit();
}

$sql = "UPDATE ORDERS SET NOTE = :NOTE WHERE ORDER_NUM = :ORDER;";
$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$success = $prepared->execute(array(':NOTE' => $n, ':ORDER' => $on));

echo "<h3>Customer Order(s)</h3>";
// Column titles
echo "<table border=1 cellspacing=2>";
echo "<tr>";
echo "<td>Order Number</td>";
echo "<td>Note</td>";
echo "</tr>";

$order = $pdo->query("SELECT * FROM ORDERS WHERE ORDER_NUM = '$on';");
$rows = $order->fetchAll(PDO::FETCH_ASSOC);

// Table data
foreach($rows as $row){
    echo "<tr>";
    echo "<td>", $row["ORDER_NUM"], "</td><td>", $row["NOTE"], "</td>";
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