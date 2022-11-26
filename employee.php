<!DOCTYPE html>
<html lang="en">
<body style="background-color:black;">
<head>
  <title>Employee Portal</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- FontAwesome 6.2.0 CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>

  <link rel="stylesheet" href="assets/stylesheet.css">
  <style>
    .nav-link:hover
    {
      --bs-nav-link-hover-color:#fc1783;
    }
    body
    {
      color:aliceblue;
    }

  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid" id="borderCALI">
        <a class="navbar-brand" href="#">
          <img src="assets/Logo.png" alt="CALICOMP" width="69" height="57">
        </a>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link fs-5 Adelhyde" href="https://students.cs.niu.edu/~z1951125/OptionalKarmotrine/html/index.php">
              <i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Bronson" href="https://students.cs.niu.edu/~z1951125/OptionalKarmotrine/html/drinks.php">
              <i class="fas fa-glass-martini"></i> Drinks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Flanergide" href="#">
              <i class="fas fa-truck-plane"></i> Find My Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Karmotrine" href="#">
              <i class="fas fa-door-closed"></i> Employee Portal</a>
            </li>
          </ul>
          <a class="nav-link justify-content-end fs-5 Delta" href="https://students.cs.niu.edu/~z1951125/OptionalKarmotrine/html/cart.php">
            <i class="fas fa-shopping-cart"></i> My Cart
          </a>
        </div>
      </div>
    </nav>
  </header>

  <?php
    include("assets/drinksLib.php");

    try
    {
        $dsn = "mysql:host=courses;dbname=z1922762";
        $pdo = new PDO($dsn, "z1922762", "2003May20");
        //$dsn = "mysql:host=courses;dbname=z1951125"; CHANGE LATER
        //$pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); CHANGE LATER
    }
    catch(PDOexception $e)
    {
        echo "Connection to database failed: " . $e->getMessage();
        die();
    }
  ?>

  <main>
    <div class="container">
      <h1>Customer Orders & Drink Inventory</h1>
        <p>Outstanding Orders</p>
        <table border=1 cellspacing=2>
        <tr>
        <td>Order Number</td>
        <td>Cost</td>
        <td>Customer Name</td>
        <td>Customer Address</td>
        <td>Customer eMail</td>
        <td>Status</td>
        <td>Note</td>
        <td>Tracking</td>
        </tr>

      <?php
        // Show table of outstanding order information
        $order = $pdo->query("SELECT * FROM ORDERS WHERE STATUS !='CANCELLED' AND STATUS != 'COMPLETED';");
        $rows = $order->fetchAll(PDO::FETCH_ASSOC);

        // Table data
        foreach($rows as $row)
        {
          echo "<tr>";
          echo "<td>", $row["ORDER_NUM"], "</td><td>", $row["COST"], "</td><td>", $row["CUS_NAME"], "</td><td>", $row["CUS_ADDRESS"], "</td><td>", $row["CUS_EMAIL"], "</td><td>", $row["STATUS"], "</td><td>", $row["NOTE"], "</td><td>", $row["TRACKING"], "</td>";
          echo "</tr>";
        }
        echo "</table>";
        echo "<br><br>";

        echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/inventory.php'>See Drink Inventory</button>";

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
            echo "<h1>Customer order details for: $on</h1>";
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
    
            echo "<h3>Order contents</h3>";
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
        else
        {
            echo "Order not found!";
            echo "<br>";
        
            echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
        }

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
            echo "<h1>Customer order status for: $on</h1>";
            print("Updated order $on status to $os");

            $sql = "UPDATE ORDERS SET STATUS = :STATUS WHERE ORDER_NUM = :ORDER";
            $prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $success = $prepared->execute(array(':STATUS' => $os, ':ORDER' => $on));
            
            
            $order = $pdo->query("SELECT * FROM ORDERS WHERE ORDER_NUM = '$on';");
            $rows = $order->fetchAll(PDO::FETCH_ASSOC);
            
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
        else
        {
            echo "Order not found!";
            echo "<br>";
        
            echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
        }

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
            echo "<h1>Customer order note for: $on</h1>";
            echo "Updated order $on";
            echo "<br>";
            echo "Note: ";
            echo $n;
            echo "<br>";
        
            $sql = "UPDATE ORDERS SET NOTE = :NOTE WHERE ORDER_NUM = :ORDER;";
            $prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $success = $prepared->execute(array(':NOTE' => $n, ':ORDER' => $on));
            
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
        else
        {
            echo "Order not found!";
            echo "<br>";
            
            echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1922762/OptionalKarmotrine/adminhome.php'>Reset</button>";
        }
        }
      ?>

      <footer class="pt-2 mt-4 text-muted border-top">
        Copyright (c) Keeree Joe Group. 2064.
        CALICOMP and Keeree Joe Group are registered tademarks of Banjo Group.
      </footer>
    </div>
  </main>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>