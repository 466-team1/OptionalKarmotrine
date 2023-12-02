<?php
session_start();
require_once '../lib/drinksLib.php';
function drinkERROR()
{
    echo "<div class=\"py-2 text-center Stella\"><h2>404, Drink not found.</h2><p>Did you get here by mistake?";
    echo "<img class=\"d-block mx-auto mb-2\" src=\"assets/drinks/ERROR.png\" id=\"borderCALI\"></div>";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Drink Details</title>
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
              <a class="nav-link fs-5 Bronson fw-bold text-decoration-underline" href="drinks.php">
              <i class="fas fa-glass-martini"></i> Drinks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Flanergide" href="orderTrack.php">
              <i class="fas fa-truck-plane"></i> Find My Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Karmotrine" href="employee.php">
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

  <?php
    if(!isset($_GET["Drink"]))
    {
        drinkERROR();
    }
    else
    {
        $name = str_replace('-', ' ', $_GET["Drink"]);

        $sql = <<<SQL
        SELECT *
            FROM DRINKS
            WHERE NAME = ?;
        SQL;

        try
        {
            $prepared = $pdo->prepare($sql);
        }
        catch(PDOException $e)
        {
          echo "Prepare Failure: " . $e->getMessage();
        }
        if(!$prepared) { die("Error in prepare."); }

        try
        {
            $result = $prepared->execute(array($name));
        }
        catch(PDOException $e)
        {
            echo "Execute Failure: " . $e->getMessage();
        }
        if(!$result) { die("Error in query."); }
        else
        {
            $rows = $prepared->fetchAll(PDO::FETCH_ASSOC);
            if(empty($rows)) { drinkERROR(); }
            else
            {
                foreach($rows as $row)
                {
                    $filename = str_replace(' ', '', $row['NAME']) . ".png";
                }
            }
        }
    }
  ?>

  <main>
    <div class="container py-4">
      <div class="row align-items-md-stretch">
        <div class="col-md-4">
          <div class="h-100 d-flex justify-content-center flex-column" id="borderCALI">
            <?php
                echo "<img class=\"img-fluid\" src=\"assets/drinks/$filename\" alt=\"{$row['NAME']}\">";
                echo "<h2 class=\"text-center\">{$row['NAME']}</h2>";
            ?>
          </div>
        </div>
        <div class="col-md-8">
          <div class="h-50 p-3">
            <?php
                echo "<h1 class=\"display-5 fw-bold Stella\">{$row['NAME']}</h1>";
                echo "<p class=\"h1 Karmotrine\">\${$row['PRICE']}</p>";
                echo"<div id=\"borderIMG\"><p class=\"fs-5\">{$row['DESC']}</p></div>";
            ?>
            <form class="row px-5" action="cartAdd.php" method="POST" validate>
              <div class="col-3">
                <input class="form-control" type="hidden" value="<?php echo $row['NAME']; ?>" name="DRINK" required>
                <input class="form-control" min="1" max="<?php echo $row['STOCK']; ?>"  type="number" placeholder="Enter Quantity" value=1 name="QTY" required>
              </div>
              <div class="col-2 p-0 text-center">
                <button class="btn btn-lg btn-val fw-bold" style="white-space:nowrap;" type="Submit">Add to cart</button>
              </div>
              <div class="col-3 text-center">
                <p class="Delta fs-4"><?php echo $row['STOCK']; ?> in stock.</p>
              </div>
            </form>
            <div style="height: 50px;"></div>
            <div class="Stella">
              <?php echo "<p>", $row['INGRED'], "</p>"; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="py-1">
        <div class="container-fluid py-4">
          <p class="col-md-8 fs-4" id="borderIMG">&ldquo;<?php echo $row['QUOTE']; ?>&rdquo;</p>
        </div>
      </div>
      <footer class="pt-2 mt-4 text-muted border-top">
        Copyright (c) Keeree Joe Group. 2064.
        CALICOMP and Keeree Joe Group are registered trademarks of Banjo Group.
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
