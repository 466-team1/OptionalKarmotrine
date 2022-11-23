<html><head><title>Admin View</title></head></html>

<?php
    try { // if something goes wrong, an exception is thrown
        $dsn = "mysql:host=courses;dbname=z1922762";
        $pdo = new PDO($dsn, "z1922762", "2003May20");

        // Show table of outstanding order information
        $order = $pdo->query("SELECT * FROM ORDERS WHERE NOT STATUS='CANCELLED' AND NOT STATUS='SHIPPED' AND NOT STATUS ='COMPLETED';");
        $rows = $order->fetchAll(PDO::FETCH_ASSOC);

        echo "<h1>Customer Orders & Drink Inventory</h1>";
        // Column titles
        echo "Outstanding Orders\n";
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
        echo "<br><br>";
    }
    catch(PDOexception $e) { // handle exception
        echo "Connection to database failed: " . $e->getMessage();
    }

    echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/inventory.php'>See Drink Inventory</button>";
?>

<?php
// Pull order information + contents
echo"<html><body>";
echo"<form action='' method='GET'>";
    echo"<br>";
    echo"<p>Pull Order Details</p>";
    echo"Order Number<input type='text' name='ordernum' required/>";
    echo"<br><br>";
    echo"<input type='submit' name='ordersubmit' value='Submit' /> <br>";
    echo"<input type='reset' name='reset' value='Reset Form' /> <br>";
echo "</form></body></html>";

if(isset($_GET['ordersubmit']))
{
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
        
        }
        else
        {
            echo "Order not found!";
            echo "<br>";
        
            echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
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

        echo "<h1>Customer order contents for: $on</h1>";
        
        $cmd = "SELECT * FROM ORDERS WHERE ORDER_NUM=?";
        $stmt = $pdo->prepare($cmd);
        $stmt->execute([$on]);
        $gt = $stmt->fetch();
        if($gt)
        {
            
        }
        else
        {
            echo "Order not found!";
            echo "<br>";
        
            echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
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
        
        $order = $pdo->query("SELECT * FROM HAS WHERE ORDER_NUM = '$on';");
        $rows = $order->fetchAll(PDO::FETCH_ASSOC);
        
        // Table data
        foreach($rows as $row){
            echo "<tr>";
            echo "<td>", $row["ORDER_NUM"], "</td><td>", $row["NAME"], "</td><td>", $row["QTY"], "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<br>";
              
        echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
        }
        
        catch(PDOexception $e) { // handle exception
        echo "Connection to database failed: " . $e->getMessage();
        }   
}
?>

<?php
echo"<html><body>";
echo"<form action='' method='POST'>";
    echo"<br>";
    echo"<p>Update order status</p>";
    echo"Order Number<input type='text' name='ordernum' required/>";
echo"<label for='status'>New Status";
    echo"<select name='status' id='status'>";
        echo"<option value='' disabled selected>Select new status</option>";
        echo"<option value='RECIEVED'>RECIEVED</option>";
        echo"<option value='PROCESSING'>PROCESSING</option>";
        echo"<option value='SHIPPED'>SHIPPED</option>";
        echo"<option value='COMPLETED'>COMPLETED</option>";
        echo"<option value='CANCELLED'>CANCELLED</option>";
        echo"</select>";
echo"</label>";
echo"<br><br>";
    echo"<input type='submit' name='statussubmit' value='Submit' /> <br>";
    echo"<input type='reset' name='reset' value='Reset Form' /> <br>";
echo"</form></body></html>";

if(isset($_POST['statussubmit']))
{
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
        
            echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
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
        
        echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
        }
        
        catch(PDOexception $e) { // handle exception
        echo "Connection to database failed: " . $e->getMessage();
        }
}
?>

<?php
echo"<html><body>";
echo"<form action='' method='POST'>";
    echo"<br>";
    echo"<p>Add note to order</p>";
    echo"Order Number<input type='text' name='ordernum' required/>";
    echo"Add Note<input type='text' name='note' />";
echo"<br><br>";
    echo"<input type='submit' name='notesubmit' value='Submit' /> <br>";
    echo"<input type='reset' name='reset' value='Reset Form' /> <br>";
echo"</form></body></html>";

if(isset($_POST['notesubmit']))
{
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
            
            echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
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
        
        echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
        }
        
        catch(PDOexception $e) { // handle exception
        echo "Connection to database failed: " . $e->getMessage();
        }
}
?>