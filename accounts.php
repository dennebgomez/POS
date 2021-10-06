
<!DOCTYPE html>
<?php
    session_start();
    include ("connectionDB.php");
?>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     
     
    <title>ADMIN PAGE</title>
  
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/vendors/css/charts/chartist.css">
 
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/app-lite.css">
  
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/pages/dashboard-ecommerce.css">
 
  </head>
<?php
    if (!empty($_SESSION['username']) && !empty($_SESSION['password']) && !empty($_SESSION['account_type']) )
    {
        if ($_SESSION['account_type'] == "ADMIN")
        {

        //account session codes.

?>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">

   <?php include ("navbarAdmin.php"); ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <br><br>
    <?php
        if (isset ($_POST['confirm']))
        {   
            if (empty($_POST['admin_password']))
            {   
                ?> 
                <script>
                    window.onload = customAlert;

                    function customAlert(){
                    
                        swal("ADMIN PASSWORD EMPTY!", "CLICK CREATE BUTTON FIRST", "error");
                    }
                    </script>
                
                    <script src = "jqueries/sweetalert.min.js">    </script> <?php
                echo " <h2 style='color:red;'>ADMIN PASSWORD EMPTY</h2> <br><br>";
            }
            else 
            {   
                $admin_password = $_POST['admin_password'];
                if ($admin_password ==  $_SESSION['password'])
                {
                    if (!empty($_POST['username']) && !empty($_POST['password']) )
                    {   
                        $password = $_POST['password'];
                        $username = $_POST['username'];
                        $account_type = $_POST['account_type'];
                        //validation if username already exist
                        $sql = "select * from accounts_tbl where username = '$username' ";
                        $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                ?> 
                                <script>
                                    window.onload = customAlert;

                                    function customAlert(){
                                    
                                        swal("FAILED, USERNAME ALREADY TAKEN.!", " ", "error");
                                    }
                                    </script>
                                
                                    <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                echo " <h2 style='color:red;'>USERNAME ALREADY TAKEN.</h2> <br><br>";
                            }
                        else 
                            {
                                //insert username and password sa database
                                $sqlInsert = "insert into accounts_tbl (username,password,account_type) values ('$username' , '$password', '$account_type');" ;
        
                                if ($conn->query($sqlInsert) === TRUE) {
                                    ?> 
                                <script>
                                    window.onload = customAlert;

                                    function customAlert(){
                                    
                                        swal("ACCOUNT CREATED!", " ", "success");
                                    }
                                    </script>
                                
                                    <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                } else {
                                echo "Error: " . $sqlInsert . "<br>" . $conn->error;
                                }
                            }
                        
                        
                    }
                }
                else 
                {   
                    ?> 
                                <script>
                                    window.onload = customAlert;

                                    function customAlert(){
                                    
                                        swal("FAILED, WRONG ADMIN PASSWORD!", " ", "error");
                                    }
                                    </script>
                                
                                    <script src = "jqueries/sweetalert.min.js">    </script> <?php
                    echo " <h2 style='color:red;'>WRONG ADMIN PASSWORD</h2> <br><br>";
                }
                
                
               
                
            }
            
           
 
        }
    ?>    

<!-- Statistics -->
<div class="row match-height">
    <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="heading-multiple-thumbnails">CREATE ACCOUNT</h4>
                   
                    <div class="heading-elements">
                         <!-- ADMIN OR CASHIER -->
                         CASHIER
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="accounts.php" method = "POST" name="create" >
                            <h3>USERNAME</h3>
                            <input id="username" placeholder ="ENTER USERNAME" name = "username" type="text" style ="width:100%; padding:15px 15px 15px 15px;">
                            <br><br>
                        
                            <h3>PASSWORD</h3>
                            <input id = "password" placeholder = "ENTER PASSWORD" name = "password" type="password" style ="width:100%; padding:15px 15px 15px 15px;">
                            <br><br>
                            <select name="account_type" id="" style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;">
                            
                                <!-- <option value="ADMIN">ADMIN</option> -->
                                <option value="CASHIER">CASHIER</option>
                            </select>
                            <br><br>
                            <button onclick="return validateForm()" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"
                            style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;"
                            id ="create" disabled>CREATE</button>
                            <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
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

                                    $('#create').attr('disabled', disableButton);
                                }
                                                            
                                function validateForm() {
                                var username = document.forms["create"]["username"].value;
                                var password = document.forms["create"]["password"].value;
                                if (username == "" || password == "") {
                                    
                                    
                                    alert ("FILL UP USERNAME AND PASSWORD");
                                 
                                    return false;
                                }
                                else 
                                {
                                     
                                }

                                }

                            </script>
                             <div class="modal-header">
                                
                                <h4 class="modal-title">PASSWORD CONFIRMATION</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                                 </div>
                                
                                 <div class="modal-body"><br><br><br>
                                 <center><h3>ENTER ADMIN PASSWORD</h3></center><br><br><br>
                                     <input name = "admin_password" placeholder ="ENTER ADMIN PASSWORD" type="password" id ="confirm_password" style ="width:100%; padding:15px 15px 15px 15px;">
                                     <br><br>
                                     <button type="submit" name ="confirm"  style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;"
                                     >CONFIRM</button>
                                 <br><br>
                                 </div>
                           
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                            </div>

                        </div>
                        </div>
                        </form>

                        

                   
                        
                    </div>
                </div>
            </div>
    </div>
     
        </div>

        <div class="card">
                <div class="card-header">
                    <h2 class="card-title" id="heading-multiple-thumbnails">EXISTING ACCOUNTS </h2> 
                    <br><br>
                    <h1 style ="color:red;">
                    <?php 
                                        if (isset($_POST['confirm_delete']))
                                        {
                                            if (!empty($_POST['admin_password']))
                                            {
                                                $admin_delete_password = $_POST['admin_password'];

                                                if ($_SESSION['password'] == $admin_delete_password)
                                                {
                                                    
                                                    $account_id_delete = $_POST['account_id_delete'];
                                                    if ($account_id_delete == $_SESSION['account_id'])
                                                    {
                                                        echo "CANNOT DELETE CURRENT ACCOUNT!";
                                                        ?> <meta http-equiv="refresh" content="2;URL= accounts.php"> <?php
                                                    }
                                                    else 
                                                    {
                                                        $sqlDelete = "delete from accounts_tbl where account_id = $account_id_delete ";

                                                        if ($conn->query($sqlDelete) === TRUE) {
                                                            ?> 
                                                    <script>
                                                        window.onload = customAlert;

                                                        function customAlert(){
                                                        
                                                            swal("ACCOUNT DELETED", " ", "success");
                                                        }
                                                        </script>
                                                    
                                                        <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                                        echo "Account Deleted Successfully";
                                                        ?> <meta http-equiv="refresh" content="3;URL= accounts.php"> <?php
                                                        } else {
                                                            echo "CANNOT DELETE CURRENT ACCOUNT! ";
                                                        }
                                                    }
                                                   
                                                }
                                                else 
                                                {
                                                    ?> 
                                                    <script>
                                                        window.onload = customAlert;
            
                                                        function customAlert(){
                                                        
                                                            swal("WRONG PASSWORD", " ", "error");
                                                        }
                                                        </script>
                                                    
                                                        <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                                }
                                            }
                                            else
                                            {
                                                echo "ENTER ADMIN PASSWORD!";
                                            }
                                        }

                     ?>
                    </h1>
                   
                    
                     
                </div>
                <div class="card-content" id ="existing_account">
                    <div class="card-body"style="overflow:auto;" >
                 
                    <table class ="table table-bordered"   >
                                <tr style ="padding:20px 20px 20px 20px">
                                    <th>USERNAME</th>
                                    <th>PASSWORD</th>
                                    <th>ACCOUNT TYPE</th>
                                    <th>DELETE</th>
                                    
                                </tr>
                                <?php 
                                //delete
                                
                                if (isset ($_POST['delete_button']) ){
                                    echo $_POST['account_id'];
                                }
                               $account_id =$_SESSION['account_id'];
                               $count = 0;
                              

                                    $sqlViewC = "SELECT * from accounts_tbl where account_id != $account_id  ";
                                    $resultViewC = $conn->query($sqlViewC); 
                                        if ($resultViewC->num_rows > 0) {
                                        while($row = $resultViewC->fetch_assoc()) {
                                            $count++;
                                         }
                                        }
                                $items_per_page = 10;
                               
                                
                                $total_pages = ceil($count/$items_per_page);
                                if (isset ($_GET['page']) && !empty ($_GET['page']))
                                {
                                    $page = $_GET['page'];
                                } 
                                else 
                                
                                $page = 1;
                                $offset = ($page-1) *$items_per_page;   
                                $sqlView = "SELECT * from accounts_tbl where account_id != $account_id limit $items_per_page offset $offset ";
                                $resultView = $conn->query($sqlView);
                                
                                if ($resultView->num_rows > 0) {
                                  // output data of each row
                                  
                                  while($row = $resultView->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['username']; ?> </td>
                                            <td><?php echo $row['password']; ?> </td>
                                            <td><?php echo $row['account_type']; ?> </td>
                                            <td>
                                                <form action="accounts.php#existing_account" method = "POST">
                                                    <input type="hidden" name ="account_id_delete" value = "<?php echo $row['account_id']; ?>">
                                                     
                                                    <button  class="btn btn-danger"
                                                    name = "delete_button" type="button" class="btn btn-info btn-lg" data-toggle="modal" 
                                                    data-target="#myModalDelete<?php echo $row['account_id']; ?>"
                                                     >DELETE<i class="ficon ft-trash"></i></button>

                                                     <div id="myModalDelete<?php echo $row['account_id']; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">            
                                                                <h4 class="modal-title">ACCOUNT DELETE VALIDATION</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                                    
                                                                            <div class="modal-body"><br><br><br>
                                                                            <center><h3>ENTER ADMIN PASSWORD</h3></center><br><br><br>
                                                                                <input placeholder= "ADMIN PASSWORD"
                                                                                name = "admin_password" type="password" id ="confirm_password" style ="width:100%; padding:15px 15px 15px 15px;">
                                                                                <br><br>
                                                                                <button type="submit" name ="confirm_delete"  style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;"
                                                                                >CONFIRM</button>
                                                                            <br><br>
                                                                            </div>
                                                                    
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                    

                                                                        
                                                            </div>

                                                        </div>
                                                        </div>       
                                                        </form>  
                                            
                                             </td>
                                                
                                           
                                        </tr>
                                         <?php 
                                        

                                  }
                                } else {
                                    echo "NO ACCOUNTS YET! <br><br>";
                                  }
                                
                                 
                                
                            
                                    
                                
                                ?>
                                
                    </table>
                                  <?php 
                                     echo '<div class ="pagination" style="margin:10px 10px 10px 10px; 
                                     margin: auto;
                                     width: 100%; float :left;
                                     
                                     padding: 10px;">';?>
                                  
                                      <?php
                                     for ($i = 1; $i <= $total_pages; $i++)
                                     {
                                         if ($i == $page)
                                         {
                                             echo '<a class="active btn btn-default" style="background-color:orange; color:white" >'.$i .'</a>';
                                         }
                                         else 
                                         {
                                           echo '<a class ="btn btn-default" style="background-color:grey; color:white" href = "accounts.php?page=' .$i .'">' .$i .'</a>';
                                         }
                                     }
   
                                     echo '</div>';
                                  ?>
                   </div>
                </div>
                                
                       
                
                        
               
         </div>
         <div class="card"  id ="change_password" >
                    <div class="card-header">
                        <h1>CHANGE PASSWORD</h1>
                        <div class="card-content">
                            <div class="card-body"style="overflow:auto;" >
                            <button  class="btn btn-success"
                             type="button" class="btn btn-info btn-lg" data-toggle="modal" 
                             data-target="#myModalEdit"
                             >CHANGE PASSWORD <i class="ficon ft-edit"></i></button>
                            </div>
                            <h1 style = "color:red;">
                            <?php
                            if (isset($_POST['change']))
                            {
                                if (!empty($_POST['current_admin_password']) && !empty($_POST['new_admin_password']) && !empty($_POST['confirm_new_admin_password']))
                                {
                                    $current_admin_password = $_POST['current_admin_password'];
                                    $new_admin_password = $_POST['new_admin_password'];
                                    $confirm_new_admin_password = $_POST['confirm_new_admin_password'];
 
                                    if ($current_admin_password === $_SESSION['password'])
                                    {
                                        
                                        if ($new_admin_password == $confirm_new_admin_password)
                                        {   
                                            $account_id = $_SESSION['account_id'];
                                            $sql = "update accounts_tbl SET password='$new_admin_password' WHERE account_id ='$account_id' ";

                                            if ($conn->query($sql) === TRUE) {
                                              echo "<h1 style ='color:green;'>PASSWORD CHANGED!</h1> ";
                                              ?> <meta http-equiv="refresh" content="2;URL= logout.php"> <?php
                                            } else {
                                              echo "Error updating record: " . $conn->error;
                                            }
                                        }
                                        else 
                                        {   
                                            ?> 
                                            <script>
                                                window.onload = customAlert;
    
                                                function customAlert(){
                                                
                                                    swal("FAILED, NEW PASSWORD DID NOT MATCH!", " ", "error");
                                                }
                                                </script>
                                            
                                                <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                            echo "NEW PASSWORD DID NOT MATCH!";
                                        }
                                    }
                                    else 
                                    {   
                                        ?> 
                                        <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("WRONG ADMIN PASSWORD", " ", "error");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                        echo "WRONG ADMIN PASSWORD";
                                        
                                    }
                                }
                                else    
                                {   
                                    ?> 
                                    <script>
                                        window.onload = customAlert;

                                        function customAlert(){
                                        
                                            swal("FILL UP ALL THE FORMS!", " ", "error");
                                        }
                                        </script>
                                    
                                        <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                    echo "FILL UP ALL THE FORMS!";
                                    
                                }
                            }
                         ?>   
                         </h1>
                        </div>
                    </div>
         </div>
         <div id="myModalEdit" class="modal fade" role="dialog">
           <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">            
                <h4 class="modal-title">CHANGE PASSWORD</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>
                                                                    
                <div class="modal-body"><br><br><br>
                <form action="accounts.php" method="POST">
                    <h2>ENTER CURRENT PASSWORD</h2><br>
                     <input name = "current_admin_password" type="password" placeholder="CURRENT PASSWORD"  style ="width:100%; padding:15px 15px 15px 15px;">
                     <br><br>
                     <h2>NEW PASSWORD</h2><br>
                     <input name = "new_admin_password" type="password"  placeholder="PASSWORD" style ="width:100%; padding:15px 15px 15px 15px;">
                     <br><br>
                     <h2>CONFIRM NEW PASSWORD</h2><br>
                     <input name = "confirm_new_admin_password" placeholder="CONFIRM PASSWORD" type="password" style ="width:100%; padding:15px 15px 15px 15px;">
                     <br><br>
                    <button type="submit" name ="change"  style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;"
                     > CHANGE <i class="ficon ft-edit"></i></button>
                     <br><br>
                     </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                      </div>
                        </div>
                         </div>  
                </form>           
                                                  
        
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
</div>

    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
      
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
            
        </ul>
      </div>
    </footer>
 
    <script src="admin assests/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
 
  </body>
  <?php 
         }
        else 
        {
            ?> <meta http-equiv="refresh" content="1;URL= cashier2.php"> <?php
        }
    }
    else 
    {
        ?> <meta http-equiv="refresh" content="1;URL= index.php"> <?php
    }
  
  ?>
</html>