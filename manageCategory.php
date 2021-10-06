 
 

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
<div id="myModalCategory" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">            
        <h4 class="modal-title">ADD PRODUCT CATEGORY</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                                    
         <div class="modal-body"><br><br><br>
         <form action="manageCategory.php" method ="POST"  >
                                                     <h4>ENTER PRODUCT CATEGORY NAME</h4>
                                                     <input placeholder="Category Name" type="text" name ="product_category_name" style ="width :100%; padding:15px 15px 15px 15px;">
                                                     <br>
                                                     <hr>
                                                     <button type= "submit" name ="add_category" class ="btn btn-default"> Add Category</button>
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

    

<div class="row match-height">
    <div class="col-xl-12 col-lg-12">
    <br><br>  
            <div class="card">
          
                <div class="card-header">
                    <h4 class="card-title" id="heading-multiple-thumbnails" style="font-size:25px;">MANAGE PRODUCTS </h4>
                     
                    <div class="heading-elements" style ="color:green;">
                   
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <button  class="btn btn-default"
                                                        type="button" class="btn btn-info btn-lg" data-toggle="modal" 
                                                        data-target="#myModalCategory"
                                                        >ADD PRODUCT CATEGORY <i class="ficon ft-plus"></i></button>

                            <table class="table "   >
                            <br><br>  <center><h1 style ="color:green;"> 
                                <?php 
                                    if (isset ($_POST['add_category']))
                                    {
                                 
                                        if (!empty($_POST['product_category_name']))
                                        {
                                            $product_category_name = $_POST['product_category_name'];
                                            $product_category_name = str_replace("'", "", $product_category_name);
                                         
                                            $sqlValid = "select * from product_category where product_category_name = '$product_category_name' ";
                                            $resultValid = $conn->query($sqlValid);

                                            if ($resultValid->num_rows > 0) {
                                                echo "<font style='color:red;'></font>";
                                                ?>
                                                <script>
                                                  window.onload = customAlert;
      
                                                  function customAlert(){
                                                  
                                                      swal("PRODUCT CATEGORY NAME ALREADY EXIST! ", " ", "error");
                                                  }
                                                  </script>
                                              
                                                  <script src = "jqueries/sweetalert.min.js">  </script>
                                                 <?php
                                            } else {
                                                    $sql = "INSERT INTO product_category (product_category_name)
                                                VALUES ('$product_category_name')";

                                                if ($conn->query($sql) === TRUE) {
                                          
                                                ?>
                                                <script>
                                                  window.onload = customAlert;
      
                                                  function customAlert(){
                                                  
                                                      swal("Added Successfully!", " ", "success");
                                                  }
                                                  </script>
                                              
                                                  <script src = "jqueries/sweetalert.min.js">  </script>
                                                 <?php
                                                } else {
                                            
                                                }
                                            }
                                                                                        
                                            
                                        }
                                        else
                                        { 
                                     
                                            ?>
                                                <script>
                                                  window.onload = customAlert;
      
                                                  function customAlert(){
                                                  
                                                      swal("PRODUCT CATEGORY NAME EMPTY!", " ", "error");
                                                  }
                                                  </script>
                                              
                                                  <script src = "jqueries/sweetalert.min.js">  </script>
                                                 <?php
                                        }
                                    }
                                    if (isset($_POST['delete'] ))
                                    {   
                                        if (!empty($_POST['admin_password']))
                                        {   
                                            if ($_POST['admin_password'] == $_SESSION['password'])
                                            {
                                                $product_category_id = $_POST['product_category_id'];
                                                $sql = "DELETE FROM product_category WHERE product_category_id=$product_category_id";
        
                                                if ($conn->query($sql) === TRUE) {
                                                    ?>
                                                    <script>
                                                      window.onload = customAlert;
          
                                                      function customAlert(){
                                                      
                                                          swal("Product Category Deleted Successfully", " ", "success");
                                                      }
                                                      </script>
                                                  
                                                      <script src = "jqueries/sweetalert.min.js">  </script>
                                                     <?php
                                               
                                                } else {
                                                echo "Error deleting record: " . $conn->error;
                                                }
                                            }
                                            else 
                                            {
                                                ?>
                                                <script>
                                                  window.onload = customAlert;
      
                                                  function customAlert(){
                                                  
                                                      swal("Wrong Password!", " ", "error");
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
                                                  
                                                      swal("Admin Password Empty", " ", "error");
                                                  }
                                                  </script>
                                              
                                                  <script src = "jqueries/sweetalert.min.js">  </script>
                                                 <?php
                                        }
                                       
                                    }

                                    if (isset($_POST['categ_edit']))
                                    {
                                     
                                       if (!empty($_POST['new_product_category_name']))
                                       {    
                                           if (!empty($_POST['admin_passwordEdit']))
                                           {
                                               if ($_POST['admin_passwordEdit'] == $_SESSION['password'])
                                               {
                                                $product_category_id =  $_POST['product_category_id'];
                                                $new_product_category_name =  $_POST['new_product_category_name'];
                                                $new_product_category_name = str_replace("'", "", $new_product_category_name);
                                                 $sqlValid2 = "select * from product_category where product_category_name = '$new_product_category_name' ";
                                                 $resultValid2 = $conn->query($sqlValid2);
     
                                                 if ($resultValid2->num_rows > 0) {
                                                  
                                                     ?>
                                                     <script>
                                                       window.onload = customAlert;
           
                                                       function customAlert(){
                                                       
                                                           swal("PRODUCT CATEGORY NAME ALREADY EXIST!", " ", "error");
                                                       }
                                                       </script>
                                                   
                                                       <script src = "jqueries/sweetalert.min.js">  </script>
                                                      <?php
                                                 } else {
                                                         $sql2 = "UPDATE product_category SET 
                                                         product_category_name='$new_product_category_name' WHERE product_category_id =$product_category_id";
     
                                                     if ($conn->query($sql2) === TRUE) {
                                                         ?>
                                                         <script>
                                                           window.onload = customAlert;
               
                                                           function customAlert(){
                                                           
                                                               swal("Change Successfully!", " ", "success");
                                                           }
                                                           </script>
                                                       
                                                           <script src = "jqueries/sweetalert.min.js">  </script>
                                                          <?php
                                                     } 
                                                 }
                                               }
                                               else 
                                               {
                                                ?>
                                                <script>
                                                  window.onload = customAlert;
      
                                                  function customAlert(){
                                                  
                                                      swal("Wrong Admin Password!", " ", "error");
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
                                              
                                                  swal("Admin Password Empty!", " ", "error");
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
                                                  
                                                      swal("PRODUCT CATEGORY NAME EMPTY!", " ", "error");
                                                  }
                                                  </script>
                                              
                                                  <script src = "jqueries/sweetalert.min.js">  </script>
                                                 <?php
                                       }
                                    }
                                    
                                ?>
                            
                            </h1></center> <br><br>
                                <tr style ="background-color:black; color:white;">
                                    <th>PRODUCT CATEGORY NAME</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                                <?php 
                                    $sqlCateg = "select * from product_category";
                                    $resultCateg = $conn->query($sqlCateg);
                                    
                                    if ($resultCateg->num_rows > 0) {
                                    // output data of each row
                                    while($rowCateg = $resultCateg->fetch_assoc()) {
                                
                                    
                                    
                                ?>
                                <tr>
                                    <td><?php echo $rowCateg['product_category_name']; ?></td>
                                
                                    <td>    
                                    <form action="manageCategory.php" method ="POST" >
                                    <input type="hidden" name="product_category_id" value=<?php echo $rowCateg['product_category_id']; ?>>
                                            <input type="text" name="new_product_category_name" style ="  padding-bottom:5px;
                                            padding-top:5px; margin-bottom:10px;" placeholder ="ENTER NEW CATEGORY NAME" >
                                     
                                         
                                            <button  class="btn btn-warning"  type="button"   data-toggle="modal" 
                                                        data-target="#myModalEdit<?php echo $rowCateg['product_category_id']; ?>"
                                                        >UPDATE <i class="ficon ft-edit"></i></button>
                                             
                                                        <div id="myModalEdit<?php echo $rowCateg['product_category_id']; ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">            
                                                       
                                                                                                                        </div>
                                                                                                                                
                                                            <div class="modal-body"> 
                                                                <center> <h1 style ="color:black;">CONFIRM ADMIN PASSWORD</h1></center>
                                                                           <br>
                                                                         <input type="password" placeholder="ADMIN PASSWORD" 
                                                                         name ="admin_passwordEdit" style ="padding-top:15px; padding-bottom:15px; width:100%;">   <br><br>
                                                                         <button type ="submit" style ="padding-top:15px; padding-bottom:15px; width:100%;"
                                                                         class ="btn btn-warning"name ="categ_edit" >CONFIRM</button>                                 
                                                            </div>
                                                                                                                        
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                </div>
                                    </td>
                                    <td>    
                                          <button  class="btn btn-danger"  type="button"   data-toggle="modal" 
                                                        data-target="#myModalDelete<?php echo $rowCateg['product_category_id']; ?>"
                                                        >DELETE <i class="ficon ft-trash"></i></button>
                                             
                                                        <div id="myModalDelete<?php echo $rowCateg['product_category_id']; ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">            
                                                       
                                                                                                                        </div>
                                                                                                                                
                                                            <div class="modal-body"> 
                                                                <center> <h1 style ="color:black;">CONFIRM ADMIN PASSWORD</h1></center>
                                                                           <br>
                                                                         <input type="password" placeholder="ADMIN PASSWORD" 
                                                                         name ="admin_password" style ="padding-top:15px; padding-bottom:15px; width:100%;">   <br><br>
                                                                         <button type ="submit" style ="padding-top:15px; padding-bottom:15px; width:100%;"
                                                                         class ="btn btn-warning"name ="delete" >CONFIRM</button>                                 
                                                            </div>
                                                                                                                        
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                </div>
                                            </form>
                                    </td>
                                    
                                </tr>
                                <?php 
                                }
                                    } else {
                                        echo "NO CATEGORIES!";
                                    }
                                ?>
                </table>
                    
                                                  
                                                     
                                         
                         
                    </div>
                </div>
            </div>
    </div>
     
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    
                                                                    
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
                                                                    

                                                                        
                                                            </div>

                                                        </div>
                                                        </div>       
</div>

 

 

  

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

                                            
        
          
                                                     
     
         
          