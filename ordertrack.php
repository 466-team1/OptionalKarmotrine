<?php
echo"<html><body>";
echo"<form action='' method='GET'>";
    echo"<br>";
    echo"<p>Enter your order number</p>";
    echo"Order Number<input type='text' name='ordernum' required/>";
    echo"<br><br>";
    echo"<input type='submit' name='ordersubmit' value='Submit' /> <br>";
    //echo"<input type='reset' name='reset' value='Reset Form' /> <br>";
echo "</form></body></html>";

if(isset($_GET['ordersubmit']))
{
    try { // if something goes wrong, an exception is thrown
        $dsn = "mysql:host=courses;dbname=z1922762";
        $pdo = new PDO($dsn, "z1922762", "2003May20");
        // Order Number
        $on = $_GET["ordernum"];
        
        
        
        
        $cmd = "SELECT * FROM ORDERS WHERE ORDER_NUM=?";
        $stmt = $pdo->prepare($cmd);
        $stmt->execute([$on]);
        $gt = $stmt->fetch();
        if($gt)
        {
            echo "<h1>Order details $on</h1>";
        }
        else
        {
            echo "Order not found!";
            //echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
            exit();
            header("refresh");
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
            //echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
            exit();
            header("refresh");
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
                      
        //echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
        }
        
        catch(PDOexception $e) { // handle exception
        echo "Connection to database failed: " . $e->getMessage();
        }   
}
?>