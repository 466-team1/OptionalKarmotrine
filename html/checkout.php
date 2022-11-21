<!DOCTYPE html>
<html lang="en">
<head>
  <title>Checkout</title>
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

  <main class="container" id="borderIMG">
    <div class="py-2 text-center">
      <img class="d-block mx-auto mb-2" src="assets/Logo.png">
      <h2>Complete your order</h2>
      <p class="lead">Please fill out the following information to finalize your order.</p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last" id="borderTECH">
        <h4 class="d-flex justify-content-between align-items-center py-2">
          <span class="Delta">Your cart</span>
          <span class="Flanergide">3 items</span>
        </h4><hr>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0 Adelhyde">Fringe Weaver</h6>
              <small class="Bronson">Quantity: 1</small>
            </div>
            <img src="assets/drinks/FringeWeaver.png" width="50px" height="60">
            <span class="Karmotrine fs-4">$260.00</span>
          </li><hr>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0 Adelhyde">Marsblast</h6>
              <small class="Bronson">Quantity: 4</small>
            </div>
            <img src="assets/drinks/Marsblast.png" width="50px" height="60">
            <span class="Karmotrine fs-4">$680.00</span>
          </li><hr>
          <li class="list-group-item d-flex justify-content-between">
            <span class="Adelhyde fs-3">Total:</span>
            <span class="Karmotrine fs-3">$940.00</span>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8" id="borderCALI">
        <h4 class="mb-3">Shipping Details</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-12">
              <label for="name" class="form-label"> <i class="fas fa-user-tie"></i> Full name</label>
              <input type="text" class="form-control" id="name" placeholder="Radigan D. Dog" value="" required>
              <div class="invalid-feedback">
                Valid name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email</label>
              <input type="email" class="form-control" id="email" placeholder="rad5hiba@glichcity.nc" required>
              <div class="invalid-feedback">
                Email address is required.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label"><i class="fas fa-address-card"></i> Full Address</label>
              <input type="text" class="form-control" id="address" placeholder="802-11 Picus Plaza, Glich City, Neo California" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" value="" id="legal" required>
            <label for="legel" class="form-check-label">I am over the age of 21 or am a lilim/other non-human sapiant species.</label>
            <div class="invalid-feedback">
              Confirmation is required.
            </div>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label"><i class="fas fa-user-tie"></i> Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label"><i class="fas fa-credit-card"></i> Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="1234123412341234" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="12-34" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label"><i class="fas fa-shield"></i> CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="000" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button class="btn btn-val btn-lg w-25" type="submit">Submit Order</button>
        </form>
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

  <script>
    (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')

      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>