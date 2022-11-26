<?php
session_start();
require_once '../lib/drinksLib.php';
if(isset($_POST['code']) && !empty($_POST['code']))
{
    $promoResult = applyPromoCode($pdo, $_POST['code']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Cart</title>
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
        <a class="navbar-brand" href="#">
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
              <a class="nav-link fs-5 Flanergide" href="#">
              <i class="fas fa-truck-plane"></i> Find My Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Karmotrine" href="#">
              <i class="fas fa-door-closed"></i> Employee Portal</a>
            </li>
          </ul>
          <a class="nav-link justify-content-end fs-5 Delta fw-bold text-decoration-underline" href="cart.php">
            <i class="fas fa-shopping-cart"></i> My Cart 
          </a>
        </div>
      </div>
    </nav>
  </header> 

  <main>
    <div class="container py-5">
      <div class="row d-flex justify-content-center">
        <div class="col-12" id="borderCALI">
          <h3 class="fw-bold m-4">Your Shopping Cart <i class="fas fa-shopping-cart"></i></h3>

          <?php drawCart($pdo); ?>
  
          <div class="card mb-4">
<?php
if(isset($_SESSION['codes']) && !empty($_SESSION['codes'])) 
{
    echo  '<div class="card-body p-2 d-flex flex-row">';
    echo  '<span class="Flanergide">Applied Promo Codes: </span>';
    foreach($_SESSION['codes'] as $code)
    {
        echo "&nbsp;$code&nbsp;";
    }
    echo  '</div>';
}
?>
            <div class="card-body">
              <form action=cart.php method=POST>
                <div class="row">
                  <div class="col-10">
                    <input type="text" name="code" id="code" class="form-control form-control-lg" placeholder="Enter Promo Code"/>
                  </div>
                  <div class= "col-2">
                    <button type="submit" class="btn btn-val btn-lg fw-bold mx-0" style="width:100%">Apply</button>
                  </div>
                </div>
              </form>
            </div>
<?php
if(isset($_POST['code']) && !empty($_POST['code'])) 
{
    echo <<<HTML
                <div class="card-body p-2 d-flex flex-row">
                  $promoResult
                </div>
    HTML;
}
?>
        </div>
          <div class="card">
            <div class="card-body row px-4 justify-content-between">
              <?php 
                if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
                {
                  $subtotal = number_format(getCartSubtotal($pdo), 2, '.', '');
                  echo "<a href=\"checkout.php\" class=\"btn btn-lg fw-bold btn-val col-2 checkout\">Checkout</a>";
                  echo "<div class=\"col-4 h3 subtotal\">";
                  echo "<span class=\"Karmotrine\" id=\"cartTotal\">Subtotal: \$$subtotal</span>";
                } 
              ?>
              </div>
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

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script type="text/javascript">
    $('.Quantity').change( function()
    {
      adjustCost(this);
    });

  function updateCart(Drink, Quantity)
  {
    var subtotal;
    $.ajax({
      method: "POST",
      url: "updateCart.php",
      data: { item: Drink, quantity: Quantity}
    })
    .done(function( data ) 
    {
      //console.log(data);
      subtotal = data.subtotal;
      updateSubtotal(subtotal);
    });
  }

  function removeCart(element, item)
  {
    const closest = $(element).closest('.cartItem');
    updateCart(item, 0);
    closest.remove();
  }

  function adjustCost(Quantity)
  {
    productDiv = $(Quantity).parent().parent();
    var price = parseFloat(productDiv.find('.price').text());
    var quantity = $(Quantity).val();
    var item = $(Quantity).parent().find('#Item').val();
    updateCart(item, quantity);
    if(quantity <= 0)
    {
      removeCart(productDiv.parent().parent().parent(), item)
    }
    else
    {
      var cost = price * quantity;
      productDiv.find('.cost').each(function ()
      {
        let prefix = "$"
        $(this).fadeOut(300);
        $(this).text(prefix.concat(cost.toFixed(2)));
        $(this).fadeIn(300);
      });
    }
  }

  function updateSubtotal(subtotal)
  {
    let prefix = "Subtotal: $";
    
    $('.subtotal').fadeOut(300, function() {
      $('#cartTotal').text(prefix.concat(subtotal.toFixed(2)));
      if(subtotal == 0)
      {
        $('.checkout').fadeOut(300);
      }
      else
      {
        $('.checkout').fadeIn(300);
      }
      $('.subtotal').fadeIn(300);
    });
  }

  </script>
</body>

</html>
