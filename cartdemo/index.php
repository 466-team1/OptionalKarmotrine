<?php

    session_start();

    //---------------------run the "unset" command to reset the current cart (dont have to wait till session ends)
    //unset($_SESSION['cart']);



    //login stuff
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

 
        //if the cart is set, then everything is working and we are on the home page
        if (isset($_SESSION['cart']))
        {
            echo "HOME PAGE. <br>";
        }
        //else, we need to make a new cart.
        else
        {

            $_SESSION['cart']=array(array("product", "quantity")); // Declaring session array
            echo "HOME PAGE. <br> <br>";
            echo "CART NOT SET, CREATING NEW ONE <br> <br>";

        }


        echo "<br> <br> <br> " . "USE THIS TO ADD DRINKS TO THE CURRENT CART:";
        echo "<br> " . "<form action=drinksub.php method=POST>";
        $rs = $pdo->query("SELECT DISTINCT NAME FROM DRINKS");

        echo "drink:    " . "<select name=drink>";

        while($data = ($rs->fetch()))
        {
            echo "<option> ". $data["NAME"] . "</option>";
        }

        echo "</select>";

        echo   "<input type=submit name=submit value=submit />";

        echo "</form>";


        echo "<button onclick=window.location.href='https://students.cs.niu.edu/~z1925422/OptionalKarmotrine/cartdemo/cart-page.php'>";
        echo "Click Here to go to the current cart" . "</button>";



        //if the drinksub page came back as positive
        if (isset($_POST["drink"]))
        {
            $drk = $_POST["drink"];
            $qnt = $_POST["quantity"];

            $max=sizeof($_SESSION['cart']);       
            $bigcheck = 0;
            for($i=1; $i<$max; $i++)
            {    
                $check = 0;
                while (list ($key) = each ($_SESSION['cart'][$i])) 
                { 
                    if ($check == 1)
                    {
                        $_SESSION['cart'][$i][$key] += $qnt;
                        $bigcheck = 1;
        
                    }
        
                    if ( $_SESSION['cart'][$i][$key] == $drk)
                    {
                        $check = 1;
                    }
        
                } // inner array while loop
        
            } // outer array for loop   
            if ($bigcheck == 0)
            {
                $b=array("product"=>"$drk","quantity"=>$qnt);
                array_push($_SESSION['cart'],$b); // Items added to cart
            }

        }


        //if the cart-page came back as positive
        if (isset($_POST["removedrink"]))
        {
            $drk = $_POST["removedrink"];
            $qnt = $_POST["removeamount"];

            $max=sizeof($_SESSION['cart']);       
            $bigcheck = 0;
            for($i=1; $i<$max; $i++)
            {    
                $check = 0;
                while (list ($key) = each ($_SESSION['cart'][$i])) 
                { 
                    if ($check == 1)
                    {
                        if (($_SESSION['cart'][$i][$key] -= $qnt) > 0)
                        {
                        $_SESSION['cart'][$i][$key] -= $qnt;
                        }
                        else
                        {
                        unset($_SESSION['cart'][$i][$key]);// $val1 is the key  of the element
                        unset($_SESSION['cart'][$i][$removeable]);// $val1 is the key  of the element
                        }
                        $bigcheck = 1;
                        break;
        
                    }
        
                    if ( $_SESSION['cart'][$i][$key] == $drk)
                    {
                        $check = 1;
                        $removeable = $key;
                    }
        
                } // inner array while loop
        
            } // outer array for loop   

        }
    
?>

