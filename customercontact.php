
<html><head><title>Contact Details</title></head></html>

<?php
try { // if something goes wrong, an exception is thrown
$dsn = "mysql:host=courses;dbname=z1922762";
$pdo = new PDO($dsn, "z1922762", "2003May20");
// Order contact
$oc = $_GET["contact"];


echo "<h1>Customer contact details for: $oc</h1>";

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

$order = $pdo->query("SELECT CUS_NAME AS 'Customer Name', CUS_ADDRESS AS 'Customer Address', CUS_EMAIL AS 'Customer eMail', NOTE FROM ORDERS WHERE ORDER_NUM = '$oc';");
$rows = $order->fetchAll(PDO::FETCH_ASSOC);

echo "<h3>Customer Order(s)</h3>";
// Column titles
echo "<table border=1 cellspacing=2>";
echo "<tr>";
echo "<td>Customer Name</td>";
echo "<td>Customer Address</td>";
echo "<td>Customer eMail</td>";
echo "<td>Note</td>";
echo "</tr>";

// Table data
foreach($rows as $row){
    echo "<tr>";
    echo "<td>", $row["Customer Name"], "</td><td>", $row["Customer Address"], "</td><td>", $row["Customer eMail"], "</td><td>", $row["NOTE"], "</td>";
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