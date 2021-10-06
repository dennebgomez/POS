<?php 
    session_start();
     unset ($_SESSION['username']);
     unset ($_SESSION['password']);
     unset ($_SESSION['account_type']);
     unset($_SESSION['transaction_id']);   
     ?> <meta http-equiv="refresh" content="2;URL= index.php"> <?php
?>