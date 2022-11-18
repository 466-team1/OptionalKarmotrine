<?php

    session_start();


    include('login.php');

    echo "<html><head><title> pagename </title></head><body>";
    echo "</body></html>";

    try { // if something goes wrong, an exception is thrown
        $dsn = "mysql:host=courses; dbname=z1925422";
        $pdo = new PDO($dsn, $username, $password);
    }
    catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }


    $drinkk = $_POST["drink"];

    echo "<br> " . "<form action=index.php method=POST>";

        echo "drink    " . "<select name=drink>";
      
            echo "<option> ". $drinkk . "</option>";
        

        echo "</select>";

        /////////////////////////////

        echo  "quantity:  " . "<input type=text name=quantity />";  

        echo   "<input type=submit name=submit value=submit />";

        echo "</form>";

  
    echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1925422/OptionalKarmotrine/cartdemo/'>";
    echo "Click Here to return without adding to the cart." . "</button>";
?>