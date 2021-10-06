 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  include("connectionDB.php"); ?>
    <?php  include ("headerLinks.php");
    session_start();
      
    ?>
    <title>POINT OF SALE SYSTEM</title>
</head>
 
 <script>
    function validateForm() {
    var username = document.forms["loginform"]["username"].value;
    var password = document.forms["loginform"]["password"].value;
    if (username == "" || password == "") {
       
      <?php  echo "<center><h1 style =color:red;>PLEASE ENTER USERNAME AND PASSWORD!</h1></center>"; ?>
        return false;
    }

    }

 </script>
<?php 

    if (isset($_POST['login_button']))
    {
        if (!empty($_POST['username']) && !empty($_POST['password']) )
            {
           $password = $_POST['password'];
           $username = $_POST['username'];
           $password = str_replace("'", "", $password);
           $username = str_replace("'", "", $username);
       
        
            $sql ="SELECT * from accounts_tbl where username = '$username' and password ='$password' limit 1 ";
            $result = $conn->query($sql);
           
            if ($result->num_rows > 0) {
                ?> <meta http-equiv="refresh" content="1;URL= account_identifier.php"> <?php
            while($row = $result->fetch_assoc()) {
                $_SESSION['account_id'] = $row['account_id'];
                 $_SESSION['username'] = $row['username'];
                 $_SESSION['password'] = $row['password'];
                 $_SESSION['account_type'] = $row['account_type'];

             }
            } 
            else 
            {

                 ?>
                 <script>
                    window.onload = customAlert;

                    function customAlert(){
                      
                           swal("WRONG USERNAME OR PASSWORD!", "TRY AGAIN!", "error");
                    }
                  </script>
                 
                 <script src = "jqueries/sweetalert.min.js">  </script>
                 <?php
            }
 
        }
        else 
        {
            echo "<center><h1 style =color:red;>PLEASE ENTER USERNAME AND PASSWORD!</h1></center>";
           
        }
        
    }
    
?>
<?php if (empty($_SESSION['username']) && empty($_SESSION['password']) )
    {
 ?>
<body 

style ="background-color:white;

  background-image: url('images/bg.jpg'); 

  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover; 

">

<br><br><br>

<div class="container">
 <div class="row">
 
        <div class="col-sm-3"></div>
    <div class="col-sm-6" style = "padding-top:50px;   ">
    <center  style ="background-color:white; padding-bottom:50px; 
    width:100%;
    -webkit-box-shadow:0 0 20px orange; 
-moz-box-shadow: 0 0 20px orange; 
box-shadow:0 0 20px orange; ">
    <form name ="loginform" method= "POST" action= "index.php" onsubmit="return validateForm()" >
        <div class="form-group">
        
        <img src="images/logo.png " style ="width:300px; height:100%; margin-bottom:-50px;"alt="">
        <br>       
        <br>       
        <font style ="font-size: 24px;   "> <b>POINT OF SALE SYSTEM</b></font>
           <br><br>
          
        <input type="text" style ="padding-top:20px; padding-bottom:20px; width:50%;  " class="form-control" 
            name ="username"
            id="username" placeholder="USERNAME">
        </div>
        <div class="form-group">
            <input type="password" style ="padding-top:20px; padding-bottom:20px; width:50%; " class="form-control" 
            name ="password"
            id="password" placeholder="PASSWORD">
        </div>
        <button id="login" name ="login_button" type ="submit" class ="btn btn-primary" 
        style ="padding-top:20px; padding-bottom:20px; width:50%; background-color:orange;" disabled>
        LOGIN</button>
    </form>
    </center>
    </div>
   
    <script type="text/javascript" src="jqueries/jquery.min.js"></script>
    <script>
         $("#username").keyup(function(event) {
                                    validateInputs();
                                });

                                $("#password").keyup(function(event) {
                                    validateInputs();
                                });
 

                                function validateInputs(){
                                    var disableButton = false;

                                    var val1 = $("#username").val();
                                    var val2 = $("#password").val();
                                

                                    if(val1.length == 0 || val2.length == 0 )
                                        disableButton = true;

                                    $('#login').attr('disabled', disableButton);
                                }
    </script>
 </div>
 <div class="col-sm-3"></div>
</div>




 
</body>
<?php 
    }
    else 
    {   
        if (!empty ($_SESSION['account_type'])) {
            $type =  $_SESSION['account_type'];
            if ($type == "CASHIER")
            {
                ?> <meta http-equiv="refresh" content="1;URL= cashier2.php"> <?php
            }
            else if ($type == "ADMIN")
            {
                ?> <meta http-equiv="refresh" content="1;URL= admin.php"> <?php
            }
        }
         
       
    }
?>
</html>