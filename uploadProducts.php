

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
        
        

<!-- Statistics -->
<div class="row match-height">
    <div class="col-xl-4 col-lg-12">
    <br><br>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="heading-multiple-thumbnails">MANAGE PRODUCTS </h4>
                     
                    <div class="heading-elements" style ="color:green;">
                    <?php 

            if (isset($_POST['upload'])){

            // unlink("product_images/604ec55c976610.35067001.png");
                $file = $_FILES['file'];

                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];

                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array (   'jpeg', 'jpg', 'png'  );

                if (in_array($fileActualExt, $allowed))
                {
                    if ($fileError === 0)
                    {
                        if ($fileSize < 10000000)
                        {   

                          
                            

                            $fileNameNew = uniqid('',true).".".$fileActualExt;
                            $fileDestination = 'product_images/'.$fileNameNew;

                           
                            

                            if (!empty($_POST['product_tile'])  //unlit validation
                            && !empty($_POST['stock_type'])  
                            && !empty($_POST['price'])
                            
                            && !empty($_POST['categories']))
                            {   
                                
                                $product_tile  = $_POST['product_tile'];
                                $stock_type= $_POST['stock_type'];
                               
                                $price= $_POST['price'];
                              
                                $categories = $_POST['categories'];
                                //check if product name exist.
                                $sqlCheck = "select * from product_tbl where product_name ='$product_tile' ";
                                $resultCheck = $conn->query($sqlCheck);
                               
                                if ($resultCheck->num_rows > 0) {
                                 
                                  ?>
                                        <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("FAIL , PRODUCT AlREADY EXIST!", "TRY AGAIN!", "error");
                                            }
                                        </script>
                                        
                                        <script src = "jqueries/sweetalert.min.js">  </script>
                                        <?php
                                  
                        
                                
                                } 
                                else 
                                {
                             
                               

                                if ($stock_type == "unlimited")
                                {
                                    $stock = -69;
                                    $stock = round($stock);
                                    $sqlLimited = "insert into product_tbl (product_name, stock_type , stock, categories, price ,  file)
                                    values ('$product_tile' , '$stock_type' ,$stock ,'$categories' , $price ,  '$fileNameNew');  ";
                                    
                                    if ($conn->query($sqlLimited) === TRUE) {
                                        move_uploaded_file($fileTmpName,$fileDestination); // upload the file
                                      echo "Product Added Successfully";
                                    
                                    } else {
                                      echo "Error: " . $sqlLimited . "<br>" . $conn->error;
                                    }
                                }
                                else if ($stock_type == "limited")
                                {
                                    if (!empty($_POST['stock']))
                                    {
                                         
                                        $stock =  $_POST['stock'];

                                              $sqlLimited = "insert into product_tbl (product_name, stock_type , stock, categories, price ,  file)
                                              values ('$product_tile' , '$stock_type' ,$stock ,'$categories' , $price ,  '$fileNameNew');  ";
                                            
                                            if ($conn->query($sqlLimited) === TRUE) {
                                                move_uploaded_file($fileTmpName,$fileDestination); // upload the file
                                            echo "Product Added Successfully";
                                            } else {
                                            echo "Error: " . $sqlLimited . "<br>" . $conn->error;
                                            }
                                    }
                                    else 
                                    {   
                                        ?> 
                                             <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("FAIL , PRODUCT DETAILS INCOMPLETE!", "TRY AGAIN!", "error");
                                            }
                                        </script>
                                        
                                        <script src = "jqueries/sweetalert.min.js">  </script>
                                        <?php 
                                        
                                    }
                                }
                                else 
                                {
                                    ?> 
                                           <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("FAIL , PRODUCT DETAILS INCOMPLETE!", "TRY AGAIN!", "error");
                                            }
                                        </script>
                                        
                                        <script src = "jqueries/sweetalert.min.js">  </script>
                                        <?php 
                                }
                                    
                               }// end of validaton of product name
                            }
                            else 
                            {
                                ?> 
                                           <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("FAIL , PRODUCT DETAILS INCOMPLETE!", "TRY AGAIN!", "error");
                                            }
                                        </script>
                                        
                                        <script src = "jqueries/sweetalert.min.js">  </script>
                                        <?php 
                            }

                             
                       
                           
                        
                            


                                            

                                            }
                                            else 
                                            {
                                                ?>
                                                <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("your file is too large!", "TRY AGAIN!", "error");
                                            }
                                        </script>
                                        
                                        <script src = "jqueries/sweetalert.min.js">  </script>
                                                
                                                
                                                <?php  
                                        
                                            }

                                        }
                                        else 
                                        {
                                            ?> 
                                            <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("there was an error upload your file.", "TRY AGAIN!", "error");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                            <?php  
                                        
                                    
                                        }

                                    }
                                    else 
                                    {
                                        ?>
                                         <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("You cannot upload this kind of file", "TRY AGAIN!", "error");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                           <?php  
                                   
                                    
                                    }
                                }

                                ?>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">

                  
                    
                                                     <button  class="btn btn-default"
                                                        type="button" class="btn btn-info btn-lg" data-toggle="modal" 
                                                        data-target="#myModalProducts"
                                                        >ADD PRODUCT <i class="ficon ft-plus"></i></button>
                                                        <br>    <br>
                                                        
                                                        <a href="manageCategory.php"  style="color:orange; font-size:20px;" >
                                                        <u>MANAGE PRODUCT CATEGORIES</u> <i class="ficon ft-edit"></i></a>
                                                 
                                                     
                                         
                         
                    </div>
                </div>
            </div>
    </div>
     
        </div>
        <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
            <div class="card-content" id ="existing_account">
                    <div class="card-body"style="overflow:auto;" >
                    <?php 
                        //check if product is 0 or nah
                        $sqlCheck1 = "SELECT * from product_tbl";
                        $resultCheck1 = $conn->query($sqlCheck1); 
                     if ($resultCheck1->num_rows > 0) {
                                        
                    
                    ?>
                    <table class ="table table-bordered  table-responsive "   >
                                <tr style ="padding:20px 20px 20px 20px; background-color:black; color:white;">
                                    <th style ="width = 30%;">PRODUCT NAME</th>
                               
                                    <th style ="width = 10%;">STOCKS</th>
                                    <th style ="width = 10%;">ADD STOCK</th>
                                    <th style ="width = 10%;">CATEGORIES</th>
                                    <th style ="width = 10%;">PRICE</th>
                                    <th style ="width = 10%;">EDIT PRICE</th>
                              
                  
                                    <th style ="width = 10%;">PRODUCT IMAGE</th>
                                    <th style ="width = 10%;">DELETE</th>
                                    
                                </tr>
                                <?php 
                                //delete
                            }        
                                
                             
                               $count = 0;
                              

                                    $sqlViewC = "SELECT * from product_tbl ";
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
                                $sqlView = "SELECT * from product_tbl limit $items_per_page offset $offset ";
                                $resultView = $conn->query($sqlView);
                                
                                if ($resultView->num_rows > 0) {
                                  // output data of each row
                                  
                                  while($row = $resultView->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['product_name']; ?> </td>
                                     
                                            <td><?php 
                                            if ($row['stock'] == -69)
                                            {
                                                echo "UNLIMITED STOCKS";
                                            }
                                            else if ($row['stock'] == 0 )
                                            {
                                                echo "OUT OF STOCK!";
                                            }
                                            else
                                            {
                                                echo $row['stock']; 
                                            } 
                                                
                                                ?> </td>
                                                <!-- //add stock -->
                                                <td> <?php if ($row['stock_type'] == 'limited') {?><button  class="btn btn-warning"
                                                        type="button" class="btn btn-info btn-lg" data-toggle="modal" 
                                                        data-target="#myModalStock<?php echo $row['product_id']; ?>"
                                                        > <i class="ficon ft-plus"></i></button>
                                                        <?php 
                                                            } else { echo "CANNOT ADD STOCK"; }
                                                        ?>
                                                        
                                                        <form action="uploadProducts.php" method = "POST">
                                                    <input type="hidden" name ="product_id" value = "<?php echo $row['product_id']; ?>">
                                                    <input type="hidden" name ="file" value = "<?php echo $row['file']; ?>">
                                                    <input type="hidden" name ="current_stock" value = <?php echo $row['stock']; ?>>
                                                 

                                                     <div id="myModalStock<?php echo $row['product_id']; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">            
                                                                <h4 class="modal-title"> </h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                                    
                                                                            <div class="modal-body">
                                                                           <center>  <h1><?php echo $row['product_name']; ?></h1> 
                                                                            <img src="product_images/<?php echo $row['file']; ?>" alt="PRODUCT IMAGE DELETED" style ="width: 150px; height:150px;">
                                                                            <br> <br>
                                                                             <input type="number" min="1" name="add_stock" placeholder ="ADD STOCK" 
                                                                             style ="width:100%; padding:15px 15px 15px 15px; ">  
                                                                            </center>
                                                                            <br> <br> <hr> <br> <br>
                                                                            <center><h3>ENTER ADMIN PASSWORD</h3></center><br>
                                                                                <input name = "admin_password" placeholder="ADMIN PASSWORD" 
                                                                                type="password" id ="confirm_password" style ="width:100%; padding:15px 15px 15px 15px;">
                                                                                <br><br>
                                                                                <button type="submit" name ="confirm_add_stock"  style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;"
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
                                              <!-- //add stock end -->
                                           
                                            <td><?php echo $row['categories']; ?> </td>
                                            <td><?php echo $row['price']; ?> </td>

                                            <td>
                                                        <!-- edit price start      -->
                                                     <form action="uploadProducts.php" method = "POST">
                                                    <input type="hidden" name ="product_id" value = "<?php echo $row['product_id']; ?>">
                                                    <input type="hidden" name ="file" value = "<?php echo $row['file']; ?>">
                                                 
                                                    
                                                    <button  class="btn btn-warning"
                                                        type="button" class="btn btn-info btn-lg" data-toggle="modal" 
                                                        data-target="#myModalPrice<?php echo $row['product_id']; ?>"
                                                        ><i class="ficon ft-edit"></i></button>

                                                     <div id="myModalPrice<?php echo $row['product_id']; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">            
                                                                <h4 class="modal-title">EDIT PRICE</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                                    
                                                                            <div class="modal-body">
                                                                           <center> <h1><?php echo $row['product_name']; ?>   <br> <?php echo "Php : ".$row['price']; ?></h1> 
                                                                            <img src="product_images/<?php echo $row['file']; ?>" alt="PRODUCT IMAGE DELETED" style ="width: 150px; height:150px;">
                                                                            </center>
                                                                            <br> <br>
                                                                             <input type="number" min="1" name="edit_price" placeholder ="ENTER NEW PRICE" 
                                                                             style ="width:100%; padding:15px 15px 15px 15px; " step=0.01>  
                                                                            </center>
                                                                            <br> <br> <hr> <br> <br>
                                                                            <center><h3>ENTER ADMIN PASSWORD</h3></center><br>
                                                                                <input name = "admin_password" type="password" placeholder= "ADMIN PASSWORD"
                                                                                 id ="confirm_password" style ="width:100%; padding:15px 15px 15px 15px;">
                                                                                <br><br>
                                                                                <button type="submit" name ="confirm_edit_price"  style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;"
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
                                                          <!-- edit price end      -->
                                            </td>
                                           
                                            <td>
                                            <img src="product_images/<?php echo $row['file']; ?>" alt="PRODUCT IMAGE DELETED" style ="width: 50px; height:50px;">
                                            
                                             </td>
                                            <td>
                                                <form action="uploadProducts.php" method = "POST">
                                                    <input type="hidden" name ="product_id" value = "<?php echo $row['product_id']; ?>">
                                                    <input type="hidden" name ="file" value = "<?php echo $row['file']; ?>">
                                                    

                                                    <button  class="btn btn-danger"
                                                    name = "delete_button" type="button" class="btn btn-info btn-lg" data-toggle="modal" 
                                                    data-target="#myModalDelete<?php echo $row['product_id']; ?>"
                                                     ><i class="ficon ft-trash"></i></button>

                                                     <div id="myModalDelete<?php echo $row['product_id']; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">            
                                                                <h4 class="modal-title">PRODUCT DELETE VALIDATION</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                                    
                                                                            <div class="modal-body">
                                                                           <center> <h1 style ="color:red;">DELETE? </h1><h1><?php echo $row['product_name']; ?></h1> 
                                                                            <img src="product_images/<?php echo $row['file']; ?>" alt="PRODUCT IMAGE DELETED" style ="width: 150px; height:100%;">
                                                                            </center>
                                                                           <br><br>
                                                                            <center><h3>ENTER ADMIN PASSWORD</h3></center><br>
                                                                                <input placeholder="ADMIN PASSWORD" name = "admin_password" type="password" id ="confirm_password" style ="width:100%; padding:15px 15px 15px 15px;">
                                                                                <br><br>
                                                                                <button type="submit" name ="confirm_product_delete"  style ="width:100%; padding:15px 15px 15px 15px; background-color:orange; color:white;"
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
                                    echo "NO PRODUCTS YET! <br><br>";
                                  }
                                
                                 
                                
                            
                                    
                                
                                ?>
                                <?php 
                                
                                //edit price 
                                if (isset($_POST['confirm_edit_price']))
                                {
                                    if (!empty($_POST['edit_price']) && !empty($_POST['admin_password']) )
                                    {
                                        $edit_price = $_POST['edit_price'];
                                        $admin_password = $_POST['admin_password'];

                                        if ($admin_password == $_SESSION['password'])
                                        {
                                           
                                            $product_id = $_POST['product_id'];
                                            
                                            $sql = "UPDATE product_tbl SET price = $edit_price  WHERE product_id= $product_id";

                                          if ($conn->query($sql) === TRUE) {
                                                        
                                          ?>
                                          <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("Price Updated Successfully", " ", "success");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                           <?php
                                                  
                                          ?> <meta http-equiv="refresh" content="3;URL= uploadProducts.php"> <?php
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
                                            
                                                swal("FAILED, WRONG PASSWORD!", " ", "error");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                              <?php
                                        }
                                    }
                                    else 
                                    {
                                        ?>
                                         <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("FAILED, EMPTY INPUTS OR PASSWORD!", " ", "error");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                             <?php
                                    }
                                    
                                }
                                //add stock code
                                    if (isset($_POST['add_stock']))
                                    {   
                                        if (!empty($_POST['admin_password']) && !empty($_POST['add_stock'])    )
                                        {
                                               $admin_password = $_POST['admin_password'];
                                               $add_stock = $_POST['add_stock'];
                                               $current_stock = $_POST['current_stock'];
                                               $product_id = $_POST['product_id'];
                                               if ($admin_password == $_SESSION['password'])
                                               {
                                                     $stock = $current_stock + $add_stock;
                                                     $sql = "UPDATE product_tbl SET stock = $stock  WHERE product_id= $product_id";

                                                    if ($conn->query($sql) === TRUE) {
                                                        
                                                        ?>
                                                         <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("Stock Updated Successfully", " ", "success");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                           <?php
                                                  
                                          ?> <meta http-equiv="refresh" content="3;URL= uploadProducts.php"> <?php
 
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
                                                
                                                    swal("FAILED, WRONG ADMIN PASSWORD!", " ", "error");
                                                }
                                                </script>
                                            
                                                <script src = "jqueries/sweetalert.min.js">  </script>
                                                  <?php
                                               }

                                        }
                                        else 
                                        {
                                            ?>
                                         <script>
                                            window.onload = customAlert;

                                            function customAlert(){
                                            
                                                swal("FAILED, EMPTY INPUTS OR PASSWORD!", " ", "error");
                                            }
                                            </script>
                                        
                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                             <?php
                                        }
                                    

                                    }
                                       //add stock code end

                                                                            if (isset($_POST['confirm_product_delete']))
                                                                            {
                                                                                if (!empty($_POST['admin_password']))
                                                                                {   
                                                                                    $admin_password = $_POST['admin_password'];
                                                                                    $product_id = $_POST['product_id'];
                                                                                    $file = $_POST['file'];
                                                                             
                                                                                    if ($admin_password == $_SESSION['password'])
                                                                                    {

                                                                                        $sqlPD = "delete from product_tbl where product_id = $product_id";

                                                                                        if ($conn->query($sqlPD) === TRUE) {
                                                                                            
                                                                                            unlink("product_images/$file"); // dito ko natapos
                                                                                            ?>   <script>
                                                                                            window.onload = customAlert;
                                                
                                                                                            function customAlert(){
                                                                                            
                                                                                                swal("PRODUCT DELETED!", " ", "success");
                                                                                            }
                                                                                            </script>
                                                                                        
                                                                                            <script src = "jqueries/sweetalert.min.js">  </script> <?php
                                                                                            ?> <meta http-equiv="refresh" content="3;URL= uploadProducts.php"> <?php
                                                                                        } else {
                                                                                        echo "Error deleting record: " . $conn->error;
                                                                                        }
                                                                                       
                                                                                    }
                                                                                    else 
                                                                                    {
                                                                                        ?><script>
                                                                                        window.onload = customAlert;
                                            
                                                                                        function customAlert(){
                                                                                        
                                                                                            swal("WRONG PASSWORD!!", " ", "error");
                                                                                        }
                                                                                        </script>
                                                                                    
                                                                                        <script src = "jqueries/sweetalert.min.js">   </script> <?php
                                                                                    }
                                                                                }
                                                                                else 
                                                                                {
                                                                                    ?> 
                                                                                    <script>
                                                                                        window.onload = customAlert;
                                            
                                                                                        function customAlert(){
                                                                                        
                                                                                            swal("FAILED, ADMIN PASSWORD EMPTY!", " ", "error");
                                                                                        }
                                                                                        </script>
                                                                                    
                                                                                        <script src = "jqueries/sweetalert.min.js">    </script> <?php
                                                                                }
                                                                            }
                                                                        ?>
                                
                    </table>
                                  <?php 
                                     echo '<div class ="pagination" style="margin:10px 10px 10px 10px; 
                                     margin: auto;
                                     width: 100%;
                                     
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
                                           echo '<a class ="btn btn-default" style="background-color:grey; color:white" href = "uploadProducts.php?page=' .$i .'">' .$i .'</a>';
                                         }
                                     }
   
                                     echo '</div>';
                                  ?>
                   </div>
                </div>
                                
                       
                
                        
               
         </div>
            </div>
     
        </div>
      </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div id="myModalProducts" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">            
        <h4 class="modal-title" style ="font-size: 40px;">ADD A PRODUCT</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                                    
         <div class="modal-body"> 
         <form action="uploadProducts.php" method ="POST" enctype="multipart/form-data">
                                                      
                                                      <input type="text" placeholder="PRODUCT NAME"  name ="product_tile" style ="width:100%; padding:15px 15px 15px 15px;">      
                                                      <br><br>
                                                      <h4 style ="width:100%; font-size :20px;  ">STOCK TYPE</h4>
                                                      
                                                       <select name="stock_type" id="select"  
                                                        style ="width:100%; background-color:orange; color:white; padding:15px 15px 15px 15px; display=none; ">
                                                            <option   value='unlimited' >UNLIMITED</option>
                                                            <option  value='limited'>BY QUANTITY</option>
                                                       </select> 
                                                       <script>
                                                    
                                                        document.getElementById("select").onchange = function () {
                                                       
                                                        document.getElementById("stock").setAttribute("disabled", "disabled");
                                                        
                                                        if (this.value == 'limited')
                                                            document.getElementById("stock").removeAttribute("disabled");
                                                            document.getElementById("stock").style.display = "inline-block";
                                                            document.getElementById("stock2").style.display = "inline-block";
                                                              
                                                        };
                                                        
                                                       </script>
                                                       <br><br>
                                                       <center><font id="stock2" style ="display: none;'width:100%; font-size :20px; padding:15px 15px 15px 15px; color:orange;"
                                                        >ENTER STOCK</font> 
                                                       <input type="number" placeholder ="STOCK"  id = "stock" title="limited"
                                                       name ="stock" min="1"
                                                        style ="display : none; width:50%; padding:15px 15px 15px 15px; color:orange;
                                                       " name = "stock" disabled> </center>
                                                              
                                                       <br>
                                                      <h4 style ="width:100%; font-size :20px;  ">CATEGORIES</h4>
                                                      
                                                      <select name="categories"   style ="width:100%; background-color:orange; color:white; padding:15px 15px 15px 15px;">
                                                           <?php 
                                                            $sqlCateg = "select * from product_category;";
                                                            $resultCateg = $conn->query($sqlCateg);
                                                            
                                                            if ($resultCateg->num_rows > 0) {
                                                              // output data of each row
                                                              echo "<option value='NO CATEGORY'>NO CATEGORY </option> ";
                                                              while($rowCateg = $resultCateg->fetch_assoc()) {
                                                                 ?> 
                                                                    <option value="<?php echo $rowCateg['product_category_name']; ?>">
                                                                    <?php echo $rowCateg['product_category_name']; ?></option>

                                                                 <?php
                                                              }
                                                              
                                                            } else {
                                                              echo "<option value='NO CATEGORY'>NO CATEGORY </option> ";
                                                            }
                                                         
                                                           ?>
                                                      </select> 
                                                        <br>
                                                      <center>  <br>
                                                       <input type="number" placeholder ="PRICE" name="price" 
                                                       step=0.01 min="0.1"
                                                       style ="width:100%; padding:15px 15px 15px 15px; color:orange;
                                                       "> </center>
                                                       
                                                       <br>
                                                     <h4>PRODUCT IMAGE</h4>
                                                    
                                                      <input  type="file" name ="file" accept="image/*"  > 
                                                     
                                                     <br>
                                                     <br>
                                                     <hr>
                                               
                                                     <button type= "submit"  style ="width:100%; background-color:orange; color:white; padding:15px 15px 15px 15px;"
                                                     name ="upload" class ="btn btn-default"> ADD </button>
                                                     <br>
                                                     <br>
                                                     </form>                                                            
        </div>
                                                                    
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

        
                                                                    

                                                                        
                                                            </div>
                                                            

                                                        </div>

                                                        
                                                        
                                                        </div>    
                                                        
                                                           
                                                        
</div>

                                                            

                                                     
  
                                                        <!-- footer start -->
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

                                            