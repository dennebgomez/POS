<!doctype html>
<html>

<head>
  <meta charset="utf-8" />
  <title></title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="cashier_css/font.css" rel='stylesheet' type='text/css'>
  <link href="cashier_css/fontawesome.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1"
    crossorigin="anonymous">
  <link rel="stylesheet" href="cashier_css/style.css">
<link rel="stylesheet" href="cashier_css/font2.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel = "icon" href = "images/icon.png" >
    <script type="text/javascript" src="jqueries/jquery.min.js"></script>
  <?php  
     include("connectionDB.php");
     session_start();
 
       ?>
       
      
</head>
<?php 
        if (!empty($_SESSION['username']) && !empty ($_SESSION['password']) && $_SESSION['account_type'] == "CASHIER" )
        {
           
            if (isset($_POST['add_to_cart']))
            {
                if (isset($_SESSION['shopping_cart']))
                {
                    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                    if (!in_array($_GET["id"], $item_array_id))
                    {
                        $count = count($_SESSION["shopping_cart"]);
                        $item_array = array(
                            'item_id' => $_GET['id'],
                            'item_name' => $_POST['product_name'],
                            'item_price' => $_POST['price'],
                            'item_quantity' => $_POST['quantity'],
                            'current_stock' => $_POST['current_stock']
                        );
                        if (!empty($_POST['quantity']) && !empty($_POST['current_stock']) )
                        {   
                            $qty = $_POST['quantity'];
                            $current_stock = $_POST['current_stock'];
                       
                            if ($current_stock != -69)
                            {   
                                 
                                if ($current_stock < $qty)
                                {   
                                    ?>
                                    <script>
                                      window.onload = customAlert;

                                      function customAlert(){
                                      
                                          swal("Not Enough Stock", " ", "error");
                                      }
                                      </script>
                                  
                                      <script src = "jqueries/sweetalert.min.js">  </script>
                                     <?php
                                     
                                }
                                else 
                                {
                                    $_SESSION["shopping_cart"][$count] = $item_array;
                                  
                                }
                            }
                            else
                            {
                                $_SESSION["shopping_cart"][$count] = $item_array;
                               
                            }
                            
                            
                        }
                       
                    }
                    else
                    {   
                        ?>
                        <script>
                          window.onload = customAlert;

                          function customAlert(){
                          
                              swal("ITEM ALREADY ADDED!.", " ", "error");
                          }
                          </script>
                      
                          <script src = "jqueries/sweetalert.min.js">  </script>
                         <?php
                        ?> 
                        <!-- <script>alert("");</script>
                        <script>window.location="cashier2.php"</script>
                         -->
                        <?php
                    }
                }
                else
                {
                    $item_array = array (
                        'item_id' => $_GET['id'],
                        'item_name' => $_POST['product_name'],
                        'item_price' => $_POST['price'],
                        'item_quantity' => $_POST['quantity'],
                        'current_stock' => $_POST['current_stock']

                    );
                    $_SESSION["shopping_cart"][0] = $item_array;
                }
            }

            if (isset($_GET["action"])){
                if ($_GET["action"] == "delete")
                {   
                    unset ($_SESSION['total']);
                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                    {
                        if ($values["item_id"] == $_GET["id"])
                        {
                            unset($_SESSION["shopping_cart"][$keys]);
                             
                        }
                    }
                }
            }
            if (isset($_POST["new_order"])){ 
                unset ($_SESSION['total']);
                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                    { 
                            unset($_SESSION["shopping_cart"][$keys]);
                           
                    }
            }
    
    ?>
<body>
  <div id="menu"  >
  
    <div class="menu-item"><a href="logout.php" style ="color:black;">LOGOUT</a></div>
    <div class="menu-item"><a href="queue.php" style ="color:black;" target="_blank">OPEN QUEUE TAB</a></div>
  
  </div>
  <div id="mainArea">
 
    <div id="sidebar">

      <button  class="btn btn-primary"      
           type="button"  data-toggle="modal" 
          data-target="#myModalOrder" id="butOrder" style ="background-color:white;color:black; margin-top:2px;"
           >ORDER QUEUES </button> <br><hr>
                                                            <div id="myModalOrder" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            
                                                                                
                    <div class="modal-body"><br><br><br>
                    <h1>ORDER QUE</h1>   
                                                            <table class="table-responsive table-border" >
                                                                           <tr style ="background-color:orange; color:white;">
                                                                            <th style ="width:40%;"> ORDER NO.</th> 
                                                                            <th style ="width:20%;">STATUS</th>
                                                                            <th style ="width:20%;">UPDATE</th>
                                                                            <th style ="width:20%;">REMOVE</th>
                                                                           </tr>

                                                                           <?php
                                                                             $sqlQue = "select * from order_tbl where status = 'PREPARING' or status = 'PLEASE COLLECT' " ;
                                                                             $rsqlQue = $conn->query($sqlQue);
                                                                             
                                                                             if ($rsqlQue->num_rows > 0) {
                                                                               // output data of each row
                                                                               while($rowrsqlQue = $rsqlQue->fetch_assoc()) {
                                                                                 
                                                                           ?>
                                                                           <tr>
                                                                               <td>
                                                                                    <?php echo $rowrsqlQue['order_id']; ?>
                                                                               </td>
                                                                               
                                                                               <td>
                                                                               <?php echo $rowrsqlQue['status']; ?>
                                                                                 
                                                                                </td>
                                                               
                                                                                <td>
                                                                                <?php 
                                                                                    if (isset ($_POST['order_update']))
                                                                                    {   
                                                                                        if (!empty($_POST['order_id']) && !empty($_POST['status']))
                                                                                        {   
                                                                                            $status = $_POST['status'];
                                                                                            $order_id2 = $_POST['order_id'];
                                                                                            $sqlOrderUpdate = "UPDATE order_tbl set status = '$status' where order_id = $order_id2; ";

                                                                                            if ($conn->query($sqlOrderUpdate) === TRUE) {
                                                                                                ?> <meta http-equiv="refresh" content="0;URL= cashier2.php"> <?php
                                                                                            }  
                                                                                  
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <form action="cashier2.php" method="POST">
                                                                                     <input type="hidden" name ="order_id" value =<?php echo $rowrsqlQue['order_id']; ?> >
                                                                                    <select name="status"  >
                                                                                         <option selected disabled hidden>
                                                                                         <?php  echo $rowrsqlQue['status']; ?></option>
                                                                                        <option value="PREPARING">PREPARING</option>
                                                                                        <option value="PLEASE COLLECT">PLEASE COLLECT</option><br>
                                                                                
                                                                                    </select>
                                                                                    <button type="submit" name = "order_update" style ="width:100%;"
                                                                                     class="btn btn-warning">UPDATE</button>
                                                                                 </form>
                                                                                 </td>
                                                                               
                                                                               
                                                                               <td> 
                                                                                    <?php
                                                                                        if(isset ($_POST['delete_order']))
                                                                                        {   
                                                                                            if (!empty($_POST['order_id']))
                                                                                            {
                                                                                                 $order_id2 = $_POST['order_id'];
                                                                                                $sqlDeleteOrder = "UPDATE order_tbl set status = 'REMOVED' where order_id = $order_id2; ";

                                                                                                    if ($conn->query($sqlDeleteOrder) === TRUE) {
                                                                                                        ?> <meta http-equiv="refresh" content="0;URL= cashier2.php"> <?php
                                                                                                    }  
                                                                                                }
                                                                                          
                                                                                        }

                                                                                    ?>
                                                                                    <form action="cashier2.php" method="POST">
                                                                                             <input type="hidden" name ="order_id" value = <?php  echo $rowrsqlQue['order_id']; ?>>
                                                                                             <button name ="delete_order" class ="btn btn-danger">REMOVE ORDER </button>
                                                                                    </form>
                                                                                      
                                                                               </td>
                                                                           </tr>

                                                                           <?php 
                                                                               }
                                                                              
                                                                            }
                                                                           ?>
                                                            </table>  

                                                                                                                     
                    </div>
                                                                    
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
                                                                    

                                                                        
                                                            </div>

                                                        </div>
                                                        </div>       
 
       <!-- queue modal                                                       -->
      <button  class="btn btn-success"      
                                                            type="button"  data-toggle="modal" 
                                                            data-target="#myModal" id="butOrder" style ="background-color:white;color:black;" 
                                                            >PROCEED ORDER<i class="ficon ft-edit"></i></button>
                                                            <br>  
                                                            <form action="cashier2.php" method="POST">
                                                                <button  style ="background-color:white;color:black; margin-top:4px;" 
                                                                type ="submit" name="new_order" class="btn btn-danger" id="butOrder"  >NEW ORDER</button>
                                                            </form>
                                                            <h1 class="sidebar-header">Receipt</h1>
      <table   id="tab" style ="width:100%;">
                                                        <?php if (!empty($_SESSION["shopping_cart"])) {
                                                            
                                                            
                                                            $sqlQue2 = "select * from order_tbl order by order_id desc limit 1 " ;
                                                             $rsqlQue2 = $conn->query($sqlQue2);
                                                                             
                                                                             if ($rsqlQue2->num_rows > 0) {
                                                                               // output data of each row
                                                                               while($rowrsqlQue2 = $rsqlQue2->fetch_assoc()) {
                                                                                  $_SESSION['current_order_id'] =  $rowrsqlQue2["order_id"];
                                                                               }
                                                                            }?> 
                                                            
                                                            <center><h1>Order No. <?php echo $_SESSION['current_order_id'] + 1; ?> </h1></center>
                                                            <tr style ="background-color:black; color:white; ">
                                                                <th style="width:60%">Product Name</th>
                                                                <th style="width:10%">QTY</th>
                                                                <th style="width:10%">Price</th>
                                                                <th style="width:10%">Total</th>
                                                                <th style="width:10%"> </th>
                                                            </tr>
                                                           
                                                             <?php
                                                        }
                                                        else 
                                                        {
                                                            ?> <h1>NO TRANSACTION YET!</h1> <?php 
                                                        }
                                                                //customer confirm code start 
                                                                if (isset($_POST['confirm_payment']))
                                                                {
                                                                    
                                                                    if (!empty($_POST['customer_payment']))
                                                                    {   
                                                                        if (!empty($_SESSION['total']))
                                                                        {
                                                                            $confirmed_total  = $_SESSION['total'];
                                                                        }
                                                                        
                                                                        $customer_payment = $_POST['customer_payment'];
                                                                        if ($customer_payment < $confirmed_total)
                                                                        {   
                                                                            
                                                                            ?>
                                                                            <script>
                                                                            window.onload = customAlert;

                                                                            function customAlert(){
                                                                            
                                                                                swal("CUSTOMER PAYMENT INVALID", " ", "error");
                                                                            }
                                                                            </script>
                                                                        
                                                                            <script src = "jqueries/sweetalert.min.js">  </script>
                                                                            <?php
                                                                        }
                                                                        else 
                                                                        {   
                                                                            date_default_timezone_set("Asia/Manila");   
                                                                            $account_id = $_SESSION['username']; 
                                                                            $date = date('Y-m-d H:i:s');
                                                                            $time = date('Y-m-d H:i:s');
                                                                           
                                                                           
                                                                           
                                                                            ?> 
                                                                             <script>
                                                                                    $(document).ready(function(){
                                                                                        $("#myModal").modal('show');
                                                                                    });
                                                                            </script>
                                                                                  <div id="myModal" class="modal fade">
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                               
                                                                                                
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <?php if (!empty($_SESSION['total']))
                                                                                                {   
                                                                                                    
                                                                                                    $change = $customer_payment - $confirmed_total;
                                                                                                            
                                                                                                    $sqlTrans = "insert into transaction_tbl ( 
                                                                                                    transaction_date, transaction_time, account_id , total)
                                                                                                    values ( '$date' , '$time' , '$account_id' , $confirmed_total) ";
                        
                                                                                                    if ($conn->query($sqlTrans) === TRUE) {
                                                                                                 
                                                                                                    $sqlCheckTI = "SELECT  * from transaction_tbl order by transaction_id desc limit 1";
                                                                                                    $resultsqlCheckTI = $conn->query($sqlCheckTI);
                                                                                                    if ($resultsqlCheckTI->num_rows > 0) {
                                                                                       
                                                                                                        while($rowsqlCheckTI = $resultsqlCheckTI->fetch_assoc()) {
                                                                                                        
                                                                                                           $_SESSION['transaction_id'] = $rowsqlCheckTI['transaction_id'];
                                                                                                         }
                                                                                                        }  
                                                                                                    $order_id = $_SESSION['transaction_id'];     
                                                                                                     
                                                                                                    $sqlOrder = " insert into order_tbl (order_id , status)
                                                                                                    values ($order_id , 'PREPARING');
                                                                                                    ";
                                                                                                    if ($conn->query($sqlOrder) === TRUE) {
                                                                                                        
                                                                                                    }    
                                                                                                   
                                                                                                    if (!empty($_SESSION["shopping_cart"]))
                                                                                                    {
                                                                                                        
                                                                                                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                                                                                                        {   
                                                                                                        
                                                                                                       
                                                                                                            $item_id = $values["item_id"]; 
                                                                                                            $ti = $_SESSION['transaction_id'];
                                                                                                            $product_name = $values['item_name'];
                                                                                                            $product_price = $values['item_price'];
                                                                                                            $quantity =   $values['item_quantity'];
                                                                                                            $current_stock2 = $values['current_stock']; 
                                                                                                            //minus stock code
                                                                                                            $minus_stock = $current_stock2 - $quantity;
                                                                                                            if ( $current_stock2 == -69)
                                                                                                            {
                                                                                                                
                                                                                                                $sql_stock = "Update product_tbl set stock = -69 where product_id = $item_id";
                                                                                                                if ($conn->query($sql_stock) === TRUE) {
                                                                                                                     
                                                                                                                }        
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                                $sql_stock = "Update product_tbl set stock = $minus_stock where product_id = $item_id";
                                                                                                                if ($conn->query($sql_stock) === TRUE) {
                                                                                                                    
                                                                                                                }  
                                                                                                            }
                                                                                                        
                                                                                                            $sqlProduct = "insert into product_in_transaction (product_id,transaction_id , quantity,
                                                                                                            product_name , product_price,date,time) 
                                                                                                            values ( $item_id , $ti ,  $quantity , '$product_name' ,$product_price, '$date' , '$time'  )
                                                                                                            ";
                                                                                                            if ($conn->query($sqlProduct) === TRUE) {
                                                                                                                
                                                                                                            }
                                                                                                            else {
                                                                                                                echo "Error: " . $sqlProduct . "<br>" . $conn->error;
                                                                                                              }
                                                                                                        }
                                                                                                    }
                                                                                                  
                                                                                                    }
                                                                                                    else {
                                                                                                        echo "Error: " . $sqlTrans . "<br>" . $conn->error;
                                                                                                      }
                                                                                                    ?>
                                                                                                
                                                                                                 <center>
                                                                                                 <h1>CHANGE</h1>
                                                                                                 <h1 style ="font-size: 50px;"> <?php   echo $change; ?></h1>
                                                                                                 <br><br><br>
                                                                                                 <script>
                                                                                                 var myApp = new function () {
                                                                                                    this.printTable = function () {
                                                                                                        var tab = document.getElementById('tab');
                                                                                                        var win = window.open('', '', 'height=500,width=500');
                                                                                                        win.document.write(tab.outerHTML);
                                                                                                        win.document.close();
                                                                                                        win.print();
                                                                                                        win.close();
                                                                                                        $('#myModal').modal('hide');
                                                                                                        
                                                                                                        
                                                                                                    }
                                                                                                }
                                                                                                 </script>
                                                                                                  
                                                                                                 <h1>PRINT RECEIPT?</h1>
                                                                                              
                                                                                                    <button type="button"  onclick="myApp.printTable()"  class="btn btn-primary">YES</button>
                                                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                                                                                                    </center>
                                                                                                    
                                                                                                    
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>  <script>
                                                                        window.onload = customAlert;

                                                                        function customAlert(){
                                                                        
                                                                            swal("ENTER CUSTOMER PAYMENT.", " ", "error");
                                                                        }
                                                                        </script>
                                                                    
                                                                        <script src = "jqueries/sweetalert.min.js">  </script>
                                                                        <?php
                                                                    }
                                                                }

                                                                if (!empty($_SESSION["shopping_cart"]))
                                                                {
                                                                    $total = 0;
                                                                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                                                                    {   
                                                                        ?> 
                                                                        <tr>
                                                                        <td><?php echo $values["item_name"]; ?></td>
                                                                        <td><?php echo $values["item_quantity"]; ?></td>
                                                                        <td><?php echo $values["item_price"]; ?></td>
                                                                     
                                                                        <td><?php  echo number_format($values["item_quantity"] * $values["item_price"] , 2);?></td>
                                                                        <td><a   class ="btn btn-danger"
                                                                         href="cashier2.php?action=delete&id=<?php echo $values["item_id"]; ?>"> 
                                                                         REMOVE</a></td>
                                                                        </tr>
                                                                        <?php 
                                                                          $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                                                    }
                                                                }
                                                             
                                                             ?>
                                                             <?php if (!empty($_SESSION["shopping_cart"])) { ?>
                                                          
                                                                <tr>
                                                                <td colspan="3" align="right" >Total</td>

                                                                <td   align="right" ><?php if (!empty($_SESSION["shopping_cart"]) ){echo number_format($total,2);  
                                                                $_SESSION['total'] = $total;
                                                               
                                                                }?></td>
                                                                <td></td>
                                                                
                                                                
                                                             </tr>
                                                             <?php
                                                        } ?>
                                                          
                                                             </table>
                                                             
        <br><br>

        <center>
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                                                          <div class="modal-content">
                                                           <div class="modal-header">            
                                                        <h4 class="modal-title"> </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                            </div>
                                                                                                                    
                                                          <div class="modal-body">
                                                                    
                                                                    <?php 
                                                                    if (!empty($_SESSION['total']))
                                                                    {
                                                                          $confirm_total = $_SESSION['total'];

                                                                      
                                                                    ?> 
                                                                    
                                                                    <h2>AMOUNT TO PAY</h2>
                                                                    <h2 style ="font-size:40px;">  <?php echo   $confirm_total; ?> 
                                                                    </h2>    
                                                                    <br><br><br>
                                                                    <h2>CUSTOMER PAYMENT AMOUNT</h2>
                                                                    <form action="cashier2.php" method="POST">
                                                                        <input type="number" name="customer_payment"  placeholder = "CUSTOMER PAYMENT"
                                                                        style ="padding : 15px 15px 15px 15px; width:100%;" min=1
                                                                        >  
                                                                        
                                                                        <button type ="submit" name ="confirm_payment" class="btn btn-success"
                                                                            style ="width:100%; margin-top:10px;"
                                                                         >CONFIRM</button>    
                                                                    </form>   
                                                                    <?php 
                                                                           }
                                                                           else 
                                                                           {
                                                                               echo "NO ORDERS YET";
                                                                           }
                                                                    ?>                                      
                                                          </div>
                                                                    
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                                    

                                                                        
                                           

                                                        </div>
                                                        </div>       
                                                            </div>
                                                         
                                                       
                                                        </center>      
    </div>
    <div id="content"> 
        <!-- content starts -->
        <form action="cashier2.php" method ="post">
                                                                        <button id="categ_button" type = "submit"
                                                                        class= "btn btn-warning"
                                                                         name = "all_products">ALL PRODUCTS!</button>
                                                                        </form>
                                                                 
                                                                        
                                                                      
                                                                        <?php
                                                                            $sqlCategButton = "select * from product_category";
                                                                            $resultsqlCategButton = $conn->query($sqlCategButton);
                                                                            
                                                                            if ($resultsqlCategButton->num_rows > 0) {
                                                                              // output data of each row
                                                                              while($rowsqlCategButton = $resultsqlCategButton->fetch_assoc()) {
                                                                                ?>  
                                                                                    <form action="cashier2.php" method="post">
                                                                                        <input type="hidden" name="category_name" 
                                                                                        value= "<?php echo $rowsqlCategButton['product_category_name'];
                                                                                     ?>">
                                                                                     <button  class= "btn btn-warning" id="categ_button" name ="category_button" type="submit">
                                                                                     <?php echo strtoupper($rowsqlCategButton['product_category_name']); 
                                                                                     ?></button>       
                                                                                     </form>   
                                                                                    
                                                                                    
                                                                                <?php
                                                                              }
                                                                            } else {
                                                                              echo "NO CATEGORY AVAILABLE!";
                                                                            }
                                                                        ?>   
                                                            <br><br><br><br><br>
                                                        <?php
                                                            
                                                            if (isset($_POST['all_products']))
                                                            {
                                                                $sql = "select * from product_tbl where stock >0 || stock = -69";
                                                                $_SESSION['sql'] = $sql;
                                                            }
                                                         
                                                            else 
                                                            {
                                                                $sql = "select * from product_tbl  where stock >0 || stock = -69";
                                                            
                                                            }
                                                            if (isset($_POST['category_button']))
                                                            {   
                                                                if (isset($_POST['all_products']))
                                                                {
                                                                    $sql = "select * from product_tbl where stock >0 || stock = -69";
                                                                    $_SESSION['sql'] = $sql;
                                                                }
                                                             
                                                                if (!empty($_POST['category_name']))
                                                                {
                                                                    $category_name = $_POST['category_name'];
                                                                    $sql = "select * from product_tbl where categories = '$category_name'  and (stock >0 || stock = -69)";
                                                                    $_SESSION['sql'] = $sql;
                                                                
                                                                }
                                                                else 
                                                                {
                                                                    $sql = "select * from product_tbl where stock >0 || stock = -69";
                                                                   
                                                                }
                                                            }
                                                            if (!empty($_SESSION['sql']))
                                                            {
                                                                $sql = $_SESSION['sql'];
                                                            }
                                                            else 
                                                            {
                                                                $sql = "select * from product_tbl  where stock >0 || stock = -69";
                                                            }
                                                           
                                                            $result = $conn->query($sql);
                                                            
                                                            if ($result->num_rows > 0) {
                                                             ?>   <div class="row"> <?php 
                                                              while($row = $result->fetch_assoc()) {
                                                            
                                                        ?>  
                                                          
                                                                <div class="column">
                                                                    <div class="card">  
                                                                    <form method="post" action ="cashier2.php?action=add&id=<?php echo $row['product_id']; ?>">
                                                                               
                                                                               <center>
                                                                                   <h5>QTY <input type="number" style ="width:70%; margin-bottom:1px;" name="quantity" value ="1" 
                                                                                   min="1" max="<?php if ($row['stock'] == -69) { echo "1000";} else {echo $row['stock'];} ?>">
                                                                                   <input type="hidden" name="current_stock" value =<?php echo $row['stock']; ?>>
                                                                                   <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                                                                   <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                                                                   <!-- <input style = "width:150px;" 
                                                                                   type="submit" name="add_to_cart" class="btn btn-warning" value="ADD TO ORDER"> -->
                                                                                 
                                                                                   <button  class ="glow" name="add_to_cart" class="btn btn-warning"  type="submit"
                                                                                    style = "width: 100%; margin-top:5px;
                                                                                     padding :10px 10px 10px 10px; background-color:orange; color:white;
                                                                                    " > ADD</button></h5>
                                                                                    </center>
                                                                                 <div class="container">
                                                                                   <img style ="object-fit: cover; width:100%; height: 150px;   border: 3px solid orange;"
                                                                                    src="product_images/<?php echo $row['file']; ?>" alt="">
                                                                              
                                                                                    <div class="centered">
                                                                                         <h5 style ="font-size:15px;  
                                                                                           text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;" 
                                                                                          > 
                                                                               
                                                                                 
                                                                                        <?php echo $row['product_name']; ?></h5> 
                                                                                     </div>  
                                                                                   </div>       
                                                                                   
                                                                                  
                                                                                  
                                                                                    
                                                                                  
                                                                               </form>
                                                                  
                                                                    </div>
                                                                </div>
                                                              
                                                          
                                                                         
                                                                           
                                                                                 
                                                                 
                                                             <?php 
                                                                     
                                                              }
                                                            } else {
                                                              echo "NO PRODUCTS";
                                                            }
                                                             ?>
                                                                   </div>
                                                            
                                                            
          
                                                        </div>

                                         
    </div>

    
  </div>
  <div id="statusBar">
    <i class="fa fa-check" aria-hidden="true"></i>
    <i class="fa fa-smile-o" aria-hidden="true"></i>
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
    ?> <meta http-equiv="refresh" content="1;URL= index.php"> <?php
}
 ?>
</html>