<?php
session_start();
require_once '../lib/drinksLib.php';
if(isset($_POST['login']) && !empty($_POST['login']))
{
    $pass=$_POST['login'];
    if($pass == "Subekan")
    {
        $_SESSION['login'] = $pass;
    }
    else
    {
        $error = true;
    }
}
if(isset($_POST['logout']))
{
    unset($_SESSION['login']);
}
if(isset($_POST['status']) && !empty($_POST['status']) && isset($_POST['ordernum']) && !empty($_POST['ordernum']) )
{
  $sql = <<<SQL
    UPDATE ORDERS 
    SET STATUS = :STATUS
    WHERE ORDER_NUM = :ORDER_NUM
    SQL;

    try
    {
        $statement = $pdo->prepare($sql);
    }
    catch(PDOexception $e)
    {
    echo "Prepare Failure: " . $e->getMessage();
    }
    if(!$statement) { die("Error in prepare."); }

    try
    {
        $result = $statement->execute([
            ':STATUS' => $_POST['status'],
            ':ORDER_NUM' => $_POST['ordernum']
        ]);
    }
    catch(PDOexception $e)
    {
        echo "Execute Failure: " . $e->getMessage();
    }
    if(!$result) { die("Error in query."); }
}
if(isset($_POST['note']) && !empty($_POST['note']) && isset($_POST['ordernum']) && !empty($_POST['ordernum']) )
{
  $sql = <<<SQL
    UPDATE ORDERS 
    SET NOTE = :NOTE
    WHERE ORDER_NUM = :ORDER_NUM
    SQL;

    try
    {
        $statement = $pdo->prepare($sql);
    }
    catch(PDOexception $e)
    {
    echo "Prepare Failure: " . $e->getMessage();
    }
    if(!$statement) { die("Error in prepare."); }

    try
    {
        $result = $statement->execute([
            ':NOTE' => $_POST['note'],
            ':ORDER_NUM' => $_POST['ordernum']
        ]);
    }
    catch(PDOexception $e)
    {
        echo "Execute Failure: " . $e->getMessage();
    }
    if(!$result) { die("Error in query."); }
}
if(isset($_POST['restock']))
{
  $sql = <<<SQL
    UPDATE DRINKS 
    SET STOCK = "69"
    SQL;

    try
    {
        $statement = $pdo->prepare($sql);
    }
    catch(PDOexception $e)
    {
    echo "Prepare Failure: " . $e->getMessage();
    }
    if(!$statement) { die("Error in prepare."); }

    try
    {
        $result = $statement->execute([]);
    }
    catch(PDOexception $e)
    {
        echo "Execute Failure: " . $e->getMessage();
    }
    if(!$result) { die("Error in query."); }
}

?>
<!DOCTYPE html>
<html lang="en">
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
    body
    {
      color: aliceblue;
    }

    .navbar
    {
      --bs-navbar-hover-color:#fc1783;
    }

    .nav
    {
      --bs-nav-link-color: #fc1783;
      --bs-nav-link-hover-color: #69d7d3;
      --bs-nav-tabs-link-hover-border-color: black;
      border-bottom: none;
    }

    .nav-tabs .nav-link.active
    {
      color: #69d7d3;
      background-color: #1F1A2D;
      border-color: #1e0c1b;
    }

  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid" id="borderCALI">
        <a class="navbar-brand" href="index.php">
          <img src="assets/Logo.png" alt="CALICOMP" width="69" height="57">
        </a>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link fs-5 Adelhyde" href="index.php">
              <i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Bronson" href="drinks.php">
              <i class="fas fa-glass-martini"></i> Drinks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Flanergide" href="orderTrack.php">
              <i class="fas fa-truck-plane"></i> Find My Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Karmotrine fw-bold text-decoration-underline" href="employee.php">
              <i class="fas fa-door-closed"></i> Employee Portal</a>
            </li>
          </ul>
          <a class="nav-link justify-content-end fs-5 Delta" href="cart.php">
            <i class="fas fa-shopping-cart"></i> My Cart:
            <?php
              $count = 0;
              if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
              {   $count = count($_SESSION['cart']);
                  
              }
              echo "<span class=\"Bronson fw-2\">($count)</span>";
             ?>
          </a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <?php
        if(!isset($_SESSION['login']) || (empty($_SESSION['login'])))
        {
          echo "<div id=\"borderTECH\">";
          echo <<<HTML
          <form class="py-2 row justify-content-center" action="" method="POST">
            <p class="text-center fs-4">Enter your password</p>
            <div class="col-2">
              <input class="form-control" type="password" name="login" placeholder="Subekan" required>
            </div>
            <div class="col-1 p-0">
              <button class="btn btn-val btn-lg fw-bold" type="submit">Submit</button>
            </div>
          </form>
          HTML;
          if(!empty($error))
          {
              echo "<p class=\"text-center Adelhyde\">Invalid Password<br>Try \"Subekan\"</p>";
          }
          echo "</div>";
          die();
        }
      ?>
      <nav>
        <div class="nav nav-tabs" id="borderTECH" role="tablist">
          <button class="nav-link active" id="nav-update-tab" data-bs-toggle="tab" data-bs-target="#nav-update" type="button" role="tab">Update Order</button>
          <button class="nav-link" id="nav-outstanding-tab" data-bs-toggle="tab" data-bs-target="#nav-outstanding" type="button" role="tab">Outstanding Orders</button>
          <button class="nav-link" id="nav-inventory-tab" data-bs-toggle="tab" data-bs-target="#nav-inventory" type="button" role="tab">Inventory</button>
          <form action="" method="POST">
            <button class="nav-link" type="submit" name="logout" role="tab">Logout</button>
          </form>
        </div>
      </nav>
      <div class="tab-content" id="borderTECH">
        <div class="tab-pane active" id="nav-update" role="tabpanel">
          <div>
            <div class="py-2 text-center">
              <h2>Lookup Order Number</h2>
              <p class="lead">Enter customer order number.</p><hr>
              <form class="py-2 row justify-content-center" action="" method="POST">
                <p>Enter order number</p>
                <div class="col-2">
                  <input class="form-control" type="number" min="1" name="ordernum" placeholder="00000000" required>
                </div>
                <div class="col-1 p-0">
                  <button class="btn btn-val btn-lg fw-bold" type="submit">Lookup</button>
                </div>
              </form>
            </div>
            <?php   
              if(isset($_POST['ordernum']) && !empty($_POST['ordernum']))
              {
                  $ordernum = $_POST['ordernum'];
                  $result = drawOrder($pdo);
                  if($result)
                  {
                    echo <<<HTML
                    <div class="p-2 m-2 row">
                      <div class="col-3">
                        <form action="" method="POST">
                          <p class="fs-5">Update order status</p>
                          <label class="fs-5" for="status">New Status
                              <select class="form-select form-select-lg" name="status" id="status" required>
                                <option value="" disabled selected>Select new status</option>
                                <option value='PROCESSING'>PROCESSING</option>
                                <option value='CONFIRMED'>CONFIRMED</option>
                                <option value='SHIPPED'>SHIPPED</option>
                                <option value='COMPLETED'>COMPLETED</option>
                                <option value='CANCELLED'>CANCELLED</option>
                              </select>
                          </label>
                          <button class="btn btn-val btn-lg fw-bold my-4" name="ordernum" value="{$ordernum}" type="submit">Update Status</button>
                        </form>
                      </div>
                      <div class="col-7">
                        <form action="" method="POST">
                          <p class="fs-5">Add note to order</p>
                          <label class="fs-5" for="note">New Note
                          <textarea class="form-control form-control-lg" name="note" id="note" rows="1" placeholder="Enter note" required></textarea>
                          <button class="btn btn-val btn-lg fw-bold my-4" name="ordernum" value="{$ordernum}" type="submit">Update Note</button>
                        </form>
                      </div>
                    </div>
                    HTML;
                  }
              }
            ?>
          </div>
        </div>      
        <div class="tab-pane" id="nav-outstanding" role="tabpanel">
          <div>
            <h1 class="p-2 m-2">Outstanding Customer Orders</h1>
            <div class="m-2 table-responsive">
              <?php
                  $outstanding = $pdo->query("SELECT * FROM ORDERS WHERE STATUS !='CANCELLED' AND STATUS != 'COMPLETED';");
                  $rows = $outstanding->fetchAll(PDO::FETCH_ASSOC);
                  if(empty($rows)) { echo "<p>No Outstanding Orders.</p>"; }
                  else 
                  {
                      echo "<table class=\"table table-sm table-bordered table-dark table-striped table-hover\">";
                      echo "<thead><tr>";
                      foreach($rows[0] as $key => $value)
                      {
                          echo "<th>$key</th>";
                      }
                      echo "</tr></thead><tbody class=\"table-group-divider\">";
                      foreach($rows as $row)
                      {
                          echo "<tr>";
                          foreach($row as $key => $value)
                          {
                              echo "<td>$value</td>";
                          }
                          echo "</tr>";
                      }
                      echo "</tbody></table>";
                  }
              ?>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="nav-inventory" role="tabpanel">
          <div>
            <h1 class="p-2 m-2">Drink Inventory</h1>
            <div class="p-2 m-2">
              <?php
                $inventory = $pdo->query("SELECT NAME, PRICE, STOCK, TYPE, CATEGORY, FLAVOR, INGRED FROM DRINKS;");
                $rows = $inventory->fetchAll(PDO::FETCH_ASSOC);
                if(empty($rows)) { echo "<p>No results found.</p>"; }
                else 
                {
                    echo "<table class=\"table table-sm table-bordered table-dark table-striped table-hover\">";
                    echo "<thead><tr>";
                    foreach($rows[0] as $key => $value)
                    {
                        echo "<th>$key</th>";
                    }
                    echo "</tr></thead><tbody class=\"table-group-divider\">";
                    foreach($rows as $row)
                    {
                        echo "<tr>";
                        foreach($row as $key => $value)
                        {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                }
              ?>
              <form action="" method="POST"><br>
                <button class="btn btn-val btn-lg fw-bold" type="submit" name="restock">Fully Restock</button>
              </form>
            </div>
          </div>
        </div>
      </div>
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
