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



    

    echo "THIS IS THE CURRENT CART: <br> <br>";

    echo "<table border=1 cellspace=3>";  
    $max=sizeof($_SESSION['cart']);
    for($i=1; $i<$max; $i++)
    {    
        echo "<tr>";     
        while (list ($key, $val) = each ($_SESSION['cart'][$i])) 
        { 
            echo " <td> $key -> $val  </td>"; 
        } // inner array while loop
        echo "</tr>";

    } // outer array for loop
    echo "</table>";

    $max=sizeof($_SESSION['cart']);

    
    echo "<br> <br> <br> " . "USE THIS TO REMOVE A CERTAIN NUMBER OF A DRINK FROM THE CURRENT CART:";
    echo "<br> " . "<form action=index.php method=POST>";

    echo "drink:    " . "<select name=removedrink>";

    for($i=1; $i<$max; $i++)
    {    
        $_SESSION['cart'];
        foreach ($_SESSION['cart'][$i] as $key => $value) 
        {
            if (!is_numeric($value)) 
            {
                echo "<option> ". $value . "</option>";
            }
        }

    } // inner array while loop
 

    echo "</select>";

    echo  "quantity:  " . "<input type=text name=removeamount />";  

    echo   "<input type=submit name=submit value=submit />";

    echo "</form>";



  
    echo " <br> <br> <button onclick=window.location.href='https://students.cs.niu.edu/~z1925422/OptionalKarmotrine/cartdemo/'>";
    echo "Click Here to return to home page." . "</button>";
?>