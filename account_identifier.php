<?php 
    session_start();
    $type = $_SESSION['account_type'];
    if ($type == "ADMIN")
    {
        ?> <meta http-equiv="refresh" content="1;URL= admin.php"> <?php
    }
    else if ($type == "CASHIER")
    {
        ?> <meta http-equiv="refresh" content="1;URL= cashier2.php"> <?php
    }
   


?>