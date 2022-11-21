<?php
    session_start();
        //---------------------run the "unset" command to reset the current cart (dont have to wait till session ends)
    //unset($_SESSION['cart']);

    //if the cart is set
    if (isset($_SESSION['cart']))
    {
    }
    //else, we need to make a new cart.
    else
    {

        $_SESSION['cart']=array(array("DRINK", "QTY")); // Declaring session array
        echo "CART NOT SET, CREATING NEW ONE <br> <br>";

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Drinks</title>
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
              <a class="nav-link fs-5 Bronson fw-bold text-decoration-underline" href="https://students.cs.niu.edu/~z1951125/OptionalKarmotrine/html/drinks.php">
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
        $dsn = "mysql:host=courses;dbname=z1951125";
        $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(PDOexception $e)
    {
        echo "Connection to database failed: " . $e->getMessage();
        die();
    }
  ?>

  <main class="container-fluid">

    <ul class="nav nav-tabs" id="borderTECH" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link fs-5 active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab">All Drinks</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fs-5" id="flavor-tab" data-bs-toggle="tab" data-bs-target="#flavor-tab-pane" type="button" role="tab">Drinks by Flavor</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fs-5" id="type-tab" data-bs-toggle="tab" data-bs-target="#type-tab-pane" type="button" role="tab">Drinks by Type</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fs-5" id="category-tab" data-bs-toggle="tab" data-bs-target="#category-tab-pane" type="button" role="tab">Drinks by Category</button>
      </li>
    </ul>
    <div class="tab-content" id="borderTECH">
      <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel">
        <h2 class="p-2 m-2">All Drinks (Alphabetical)</h2>
        <div class="table-responsive" id="borderIMG">
          <?php
            $result = $pdo->query("SELECT * FROM DRINKS WHERE CATEGORY != 'Secret';");
            drawCards($result->fetchAll(PDO::FETCH_ASSOC));
          ?>
        </div>
      </div>

      <div class="tab-pane fade" id="flavor-tab-pane" role="tabpanel">
        <h2 class="p-2 m-2">Drinks by Flavor</h2>
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="bitter-tab" data-bs-toggle="tab" data-bs-target="#bitter-tab-pane" type="button" role="tab">Bitter</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="bubbly-tab" data-bs-toggle="tab" data-bs-target="#bubbly-tab-pane" type="button" role="tab">Bubbly</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="sour-tab" data-bs-toggle="tab" data-bs-target="#sour-tab-pane" type="button" role="tab">Sour</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="spicy-tab" data-bs-toggle="tab" data-bs-target="#spicy-tab-pane" type="button" role="tab">Spicy</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="sweet-tab" data-bs-toggle="tab" data-bs-target="#sweet-tab-pane" type="button" role="tab">Sweet</button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade" id="bitter-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectFlavor($pdo, 'Bitter')?>
            </div>
          </div>
          <div class="tab-pane fade" id="bubbly-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectFlavor($pdo, 'Bubbly')?>
            </div>
          </div>
          <div class="tab-pane fade" id="sour-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectFlavor($pdo, 'Sour')?>
            </div>
          </div>
          <div class="tab-pane fade" id="spicy-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectFlavor($pdo, 'Spicy')?>
            </div>
          </div>
          <div class="tab-pane fade" id="sweet-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectFlavor($pdo, 'Sweet')?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="tab-pane fade" id="type-tab-pane" role="tabpanel">
        <h2 class="p-2 m-2">Drinks by Type</h2>
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="classic-tab" data-bs-toggle="tab" data-bs-target="#classic-tab-pane" type="button" role="tab">Classic</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="classy-tab" data-bs-toggle="tab" data-bs-target="#classy-tab-pane" type="button" role="tab">Classy</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="girly-tab" data-bs-toggle="tab" data-bs-target="#girly-tab-pane" type="button" role="tab">Girly</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="manly-tab" data-bs-toggle="tab" data-bs-target="#manly-tab-pane" type="button" role="tab">Manly</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="promo-tab" data-bs-toggle="tab" data-bs-target="#promo-tab-pane" type="button" role="tab">Promo</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade" id="classic-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectType($pdo, 'Classic')?>
            </div>
          </div>
          <div class="tab-pane fade" id="classy-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectType($pdo, 'Classy')?>
            </div>
          </div>
          <div class="tab-pane fade" id="girly-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectType($pdo, 'Girly')?>
            </div>
          </div>
          <div class="tab-pane fade" id="manly-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectType($pdo, 'Manly')?>
            </div>
          </div>
          <div class="tab-pane fade" id="promo-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectType($pdo, 'Promo')?>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="category-tab-pane" role="tabpanel">
        <h2 class="p-2 m-2">Drinks by Category</h2>
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="bland-tab" data-bs-toggle="tab" data-bs-target="#bland-tab-pane" type="button" role="tab">Bland</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="burning-tab" data-bs-toggle="tab" data-bs-target="#burning-tab-pane" type="button" role="tab">Burning</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="happy-tab" data-bs-toggle="tab" data-bs-target="#happy-tab-pane" type="button" role="tab">Happy</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="secret-tab" data-bs-toggle="tab" data-bs-target="#secret-tab-pane" type="button" role="tab">Secret</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="sobering-tab" data-bs-toggle="tab" data-bs-target="#sobering-tab-pane" type="button" role="tab">Sobering</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="soft-tab" data-bs-toggle="tab" data-bs-target="#soft-tab-pane" type="button" role="tab">Soft</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="strong-tab" data-bs-toggle="tab" data-bs-target="#strong-tab-pane" type="button" role="tab">Strong</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fs-5" id="vintage-tab" data-bs-toggle="tab" data-bs-target="#vintage-tab-pane" type="button" role="tab">Vintage</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade" id="bland-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectCategory($pdo, 'Bland')?>
            </div>
          </div>
          <div class="tab-pane fade" id="burning-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectCategory($pdo, 'Burning')?>
            </div>
          </div>
          <div class="tab-pane fade" id="happy-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectCategory($pdo, 'Happy')?>
            </div>
          </div>
          <div class="tab-pane fade" id="secret-tab-pane" role="tabpanel">
            <div class="text-center" id="borderIMG">
              <img class="d-block mx-auto mb-2" src="assets/annagraem.gif" id="borderTECH" onclick="this.src='assets/nosignal.png'">
              <p>01000110 01101100 01100001 01101101 01101001 01101110 01100111 01001101 01101111 01100001 01101001</p>
            </div>
          </div>
          <div class="tab-pane fade" id="sobering-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectCategory($pdo, 'Sobering')?>
            </div>
          </div>
          <div class="tab-pane fade" id="soft-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectCategory($pdo, 'Soft')?>
            </div>
          </div>
          <div class="tab-pane fade" id="strong-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectCategory($pdo, 'Strong')?>
            </div>
          </div>
          <div class="tab-pane fade" id="vintage-tab-pane" role="tabpanel">
            <div id="borderIMG">
              <?php selectCategory($pdo, 'Vintage')?>
            </div>
          </div>
        </div>
      </div>

    </div>
    <footer class="pt-2 mt-4 text-muted border-top">
      Copyright (c) Keeree Joe Group. 2064.
      CALICOMP and Keeree Joe Group are registered tademarks of Banjo Group.
    </footer>

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
