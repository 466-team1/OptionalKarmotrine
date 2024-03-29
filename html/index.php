<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
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
    body {
      background-image:url(assets/CRS1.png);
      background-repeat:no-repeat;
      background-size:cover;
      background-position: 0px 120px;
      filter: blur();
      color: aliceblue;
    }

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
              <a class="nav-link fs-5 Adelhyde fw-bold text-decoration-underline" href="index.php">
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

  <main class="d-flex flex-column h-100">
    <div style="background-color: #000000a0; padding-top: 10%;">
      <div class="text-center">
        <h1 class="fs-1 fw-bolder">Welcome to Va-11 Hall-A</h1>
        <p class="fs-4">Once only a popular nighttime bar serving the people of Glitch City, 
          <br>We've since expended our business to offer an authentic bar-quality experience from home.</p>
        <p class="lead">
          <a href="drinks.php" class="btn btn-lg fw-bold btn-val">See our drinks.</a>
        </p>
      </div>
    </div>
  </main>
  <footer class="text-muted text-center">
      Copyright (c) Keeree Joe Group. 2064.
      CALICOMP and Keeree Joe Group are registered trademarks of Banjo Group.
  </footer>

    <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
