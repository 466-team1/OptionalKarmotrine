<!DOCTYPE html>
<html lang="en">
<head>
  <title>Drinks page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
function draw_table($rows){
  echo "<table border=1 cellspacing=1>";
  echo "<tr>";
  foreach($rows[0] as $key => $item ){
    echo "<th>$key</th>";
  }
  echo "</tr>";
  foreach($rows as $row){
    echo "<tr>";
    foreach($row as $key => $item){
      echo "<td><a href=\"#\">$item</a></td>";
    }
    echo "</tr>";
  }
  echo "</table>";
}?>

<div class="container">
  <h2>All Drinks</h2>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Sorted Alphabetically</a></li>
    <li><a data-toggle="tab" href="#menu1">Sorted by Flavor</a></li>
    <li><a data-toggle="tab" href="#menu2">Sorted by Type</a></li>
  </ul>
  <style>
    #p2{
        display:inline;
    }
      </style>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
<?php
    try {
      $dsn = "mysql:host=courses;dbname=z1926968";
      $username = "z1926968";
      $password = "2003Jun19";
      $pdo = new PDO($dsn, $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' ORDER BY NAME;");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="menu1" class="tab-pane fade">
  <div class="container">
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#Sour">Sour</a></li>
    <li><a data-toggle="pill" href="#Sweet">Sweet</a></li>
    <li><a data-toggle="pill" href="#Bubbly">Bubbly</a></li>
    <li><a data-toggle="pill" href="#Bitter">Bitter</a></li>
    <li><a data-toggle="pill" href="#Spicy">Spicy</a></li>
  </ul>
  <div class="tab-content">
    <div id="Sour" class="tab-pane fade in active">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && FLAVOR = 'Sour';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Sweet" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && FLAVOR = 'Sweet';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Bubbly" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && FLAVOR = 'Bubbly';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Bitter" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && FLAVOR = 'Bitter';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Spicy" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && FLAVOR = 'Spicy';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
  </div>
</div>
    </div>
    <div id="menu2" class="tab-pane fade">
  <div class="container">
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#Classy">Classy</a></li>
    <li><a data-toggle="pill" href="#Classic">Classic</a></li>
    <li><a data-toggle="pill" href="#Promo">Promo</a></li>
    <li><a data-toggle="pill" href="#Girly">Girly</a></li>
    <li><a data-toggle="pill" href="#Manly">Manly</a></li>
  </ul>
  <div class="tab-content">
    <div id="Classy" class="tab-pane fade in active">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && TYPE = 'Classy';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Classic" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && TYPE = 'Classic';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Promo" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && TYPE = 'Promo';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Girly" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && TYPE = 'Girly';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
    <div id="Manly" class="tab-pane fade">
<?php
    try {
      $rs = $pdo->query("SELECT NAME FROM DRINKS WHERE NAME != 'Flaming Moai' && TYPE = 'Manly';");

      $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

      draw_table($rows);
    }
    catch(PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
    }
?>
    </div>
  </div>
</div>

</body>
</html>
