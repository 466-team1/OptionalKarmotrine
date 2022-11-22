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


<html><body>
<form action="https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/orderpull.php" method="GET">
    <br>
    <p>Pull Order Details</p>
    Order Number<input type="text" name="ordernum" required/>
<br><br>
    <input type="submit" name="submit" value="Submit" /> <br>
    <input type="reset" name="reset" value="Reset Form" /> <br>
</form></body></html>


<html><body>
<form action="https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/customercontact.php" method="GET">
    <br>
    <p>Pull Customer Contact</p>
    Order Number<input type="text" name="contact" required/>
<br><br>
    <input type="submit" name="submit" value="Submit" /> <br>
    <input type="reset" name="reset" value="Reset Form" /> <br>
</form></body></html>


<html><body>
<form action="https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/ordercontents.php" method="GET">
    <br>
    <p>Pull Order Contents</p>
    Order Number<input type="text" name="contents" required/>
<br><br>
    <input type="submit" name="submit" value="Submit" /> <br>
    <input type="reset" name="reset" value="Reset Form" /> <br>
</form></body></html>


<html><body>
<form action="https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/orderstatus.php" method="POST">
    <br>
    <p>Update order status</p>
    Order Number<input type="text" name="ordernum" required/> 
<label for="status">New Status
    <select name="status" id="status">
        <option value="" disabled selected>Select new status</option>
        <option value="RECIEVED">RECIEVED</option>
        <option value="PROCESSING">PROCESSING</option>
        <option value="SHIPPED">SHIPPED</option>
        <option value="COMPLETED">COMPLETED</option>
        <option value="CANCELLED">CANCELLED</option>
    </select>
</label>
<br><br>
    <input type="submit" name="submit" value="Submit" /> <br>
    <input type="reset" name="reset" value="Reset Form" /> <br>
</form></body></html>


<html><body>
<form action="https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/ordernote.php" method="POST">
    <br>
    <p>Add note to order</p>
    Order Number<input type="text" name="ordernum" required/>
    Add Note<input type="text" name="note" /> 
<br><br>
    <input type="submit" name="submit" value="Submit" /> <br>
    <input type="reset" name="reset" value="Reset Form" /> <br>
</form></body></html>