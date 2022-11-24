<?php

    echo "<html><head><title> pagename </title></head><body>";
    echo "</body></html>";

    try { // if something goes wrong, an exception is thrown
        $dsn = "mysql:host=courses; dbname=z1925422";
        $pdo = new PDO($dsn, "z1925422", "2003Jan18");
        }
        catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
        }

    session_start();
        //---------------------run the "unset" command to reset the current cart (dont have to wait till session ends)
    //unset($_SESSION['cart']);

    //if the cart is set
    if (isset($_SESSION['cart']))
    {
        echo "session exists whoooo";
    }
    else //else, we need to make a new cart.
    {

       $_SESSION['cart']=array(array("DRINK", "QTY")); // Declaring session array
        echo "CART NOT SET, CREATING NEW ONE<br>";

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
              <a class="nav-link fs-5 Adelhyde" href="https://students.cs.niu.edu/~z1925422/OptionalKarmotrine/html/index.php">
              <i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 Bronson" href="https://students.cs.niu.edu/~z1925422/OptionalKarmotrine/html/drinks.php">
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
          <a class="nav-link justify-content-end fs-5 Delta fw-bold text-decoration-underline" href="https://students.cs.niu.edu/~z1925422/OptionalKarmotrine/html/cart.php">
            <i class="fas fa-shopping-cart"></i> My Cart
          </a>
        </div>
      </div>
    </nav>
  </header> 

  <main>
    <div class="h-100">
      <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12" id="borderCALI">
            <h3 class="fw-bold m-4">Your Shopping Cart <i class="fas fa-shopping-cart"></i></h3>

            <div class="cartItem">  
              <div class="card mb-4" id="borderCALI">
                <div class="card-body p-4">
                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img src="assets/drinks/FringeWeaver.png">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <p class="fw-normal mb-2 fs-5 Adelhyde">Fringe Weaver</p>
                      <p class="Flanergide"><span class="Bronson">Flavor: </span>Bubbly <span class="Bronson">Type: </span>Classy
                      <br><span class="Bronson">Catagory: </span>Strong <span class="Karmotrine">Price: $</span><span class="Karmotrine price">260.00</span></p>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2" 
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                        <i class="fas fa-minus Delta"></i>
                      </button>
      
                      <input id="Quantity" min="0" name="quantity" value="1" type="number"
                        class="form-control form-control-sm Quantity"/>
      
                      <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                        <i class="fas fa-plus Delta"></i>
                      </button>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h2 class="mb-0 Karmotrine cost">$260.00</h5>
                    </div>

                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <button class="btn btn-link px-2" onclick="removeCart(this)"> <i class="fas fa-trash fa-lg Stella"></i></button>
                    </div>
                  </div>
                </div> 
              </div> 
            </div>


<?php //EXPERIMENTAL STUFFS 
    $max=sizeof($_SESSION['cart']);
    for($i = 1; $i < $max; $i++)
    { 
      echo "WHERE IS THIS IDEK MAN. <br>";
        while (list ($key, $val) = each ($_SESSION['cart'][$i])) 
        { 
          echo "WHERE IS THIS IDEK MAN PART 2. <br>";

          if (!is_numeric($val))
          {
            $val = preg_replace('/(?<! )(?<!^)[A-Z]/',' $0', $val);
          
            $rs = $pdo->query("SELECT * FROM DRINKS WHERE NAME = '$val' ");
    
            while($data = ($rs->fetch()))
            {
              echo "WHERE IS THIS IDEK MAN PART 3. <br>";
              $daval = current($_SESSION['cart'][$i]); 


              ?>
              <div class="cartItem">  
              <div class="card mb-4" id="borderCALI">
                <div class="card-body p-4">
                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img src="assets/drinks/FringeWeaver.png">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <p class="fw-normal mb-2 fs-5 Adelhyde"><?php echo $data['NAME']; ?> </p>
                      <p class="Flanergide"><span class="Bronson">Flavor: </span><?php echo $data['FLAVOR'] . " "; ?><span class="Bronson">Type: </span><?php echo $data['TYPE'] . " ";?>
                      <br><span class="Bronson">Catagory: </span> <?php echo $data['CATEGORY']; ?> <span class="Karmotrine">Price: $</span><span class="Karmotrine price"> <?php echo $data['PRICE'];?> </span></p>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2" 
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                        <i class="fas fa-minus Delta"></i>
                      </button>

                      
                      <input id="Quantity" min="0" name= "quantity" value= <?php echo $daval; ?> type="number"
                        class="form-control form-control-sm Quantity"/>
      
                      <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                        <i class="fas fa-plus Delta"></i>
                      </button>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h2 class="mb-0 Karmotrine cost"> <?php echo $data['PRICE']; ?> </h5>
                    </div>

                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <button class="btn btn-link px-2" onclick="removeCart(this)"> <i class="fas fa-trash fa-lg Stella"></i></button>
                    </div>
                  </div>
                </div> 
              </div> 
            </div>  
              
            <?php   

          }
        }
      } // inner array while loop

    } // outer array for loop
    
    ?>

             <div class="cartItem">  
              <div class="card mb-4" id="borderCALI">
                <div class="card-body p-4">
                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img src="assets/drinks/Marsblast.png">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <p class=" fw-normal mb-2 fs-5 Adelhyde">Marsblast</p>
                      <p class="Flanergide"><span class="Bronson">Flavor: </span>Spicy <span class="Bronson">Type: </span>Manly
                      <br><span class="Bronson">Catagory: </span>Strong <span class="Karmotrine">Price: $</span><span class="Karmotrine price">170.00</span></p>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2" 
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                        <i class="fas fa-minus Delta"></i>
                      </button>
      
                      <input id="Quantity" min="0" name="quantity" value="1" type="number"
                        class="form-control form-control-sm Quantity"/>
      
                      <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp(), adjustCost(this.parentNode.querySelector('input[type=number]'))">
                        <i class="fas fa-plus Delta"></i>
                      </button>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h2 class="mb-0 Karmotrine cost">$170.00</h5>
                    </div>

                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <button class="btn btn-link px-2" onclick="removeCart(this)"> <i class="fas fa-trash fa-lg Stella"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    
            <div class="card mb-4">
              <div class="card-body p-2 d-flex flex-row">
                <div class="form-outline flex-fill">
                  <input type="text" id="code" class="form-control form-control-lg" placeholder="Enter Promo Code"/>
                </div>
                <button type="button" class="btn btn-val btn-lg fw-bold ms-3 col-1">Apply</button>
              </div>
            </div>
    
            <div class="card">
              <div class="card-body row px-4 justify-content-between">
                <button type="button" class="btn btn-val btn-lg fw-bold col-2 checkout">Checkout</button>
                <div class="col-4 h3 subtotal">
                  <span class="Karmotrine" id="cartTotal">Subtotal: $0</span>
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
  </script>

  <script type="text/javascript">
  function removeCart(element)
  {
    const closest = $(element).closest('.cartItem');
    closest.remove();
    calculateTotal();
  }
  </script>

  <script type="text/javascript">
    function adjustCost(Quantity)
    {
      productDiv = $(Quantity).parent().parent();
      var price = parseFloat(productDiv.find('.price').text());
      var quantity = $(Quantity).val();
      if(quantity == 0)
      {
        removeCart(productDiv.parent().parent().parent())
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
        calculateTotal();
      }
    }
  </script>

  <script type="text/javascript">
  function calculateTotal()
  {
    var subtotal = 0;
    let prefix = "Subtotal: $";

    $('.cost').each(function ()
    {
      let withoutDollar = $(this).text().substring(1);
      subtotal += parseFloat(withoutDollar);
    });
    
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

  <script type="text/javascript">
    calculateTotal()
  </script>
</body>

</html>