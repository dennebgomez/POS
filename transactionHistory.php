
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
    
        <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
            <br>
            <div class="card">
          
                <div class="card-header">
             
                    <h4 class="card-title"  id="heading-multiple-thumbnails">TRANSACTIONS</h4>
                
                  
                </div>
                <div class="card-content">
                
                    <div class="card-body" >
                    <center>
                    <form action= "transactionHistory.php" method="POST" style ="  float:left;">
                            <label for="transaction_date"> SELECT TRANSACTION DATE : </label>
                            <input type="date" id="transaction_date" name="transaction_date">
                            <input type="submit" name="search_date" value ="SEARCH"  style ="background-color:orange; color:white; " class = "btn btn-default">
                    </form>
                    <br><br><br>
                    </center>
                   
                     <script type="text/javascript">
                        function fnExcelReport()
                                {
                                    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
                                    var textRange; var j=0;
                                    tab = document.getElementById('table'); // id of table

                                    for(j = 0 ; j < tab.rows.length ; j++) 
                                    {     
                                        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                                        //tab_text=tab_text+"</tr>";
                                    }

                                    tab_text=tab_text+"</table>";
                                    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
                                    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                                    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

                                    var ua = window.navigator.userAgent;
                                    var msie = ua.indexOf("MSIE "); 

                                    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                                    {
                                        txtArea1.document.open("txt/html","replace");
                                        txtArea1.document.write(tab_text);
                                        txtArea1.document.close();
                                        txtArea1.focus(); 
                                        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
                                    }  
                                    else                 //other browser not tested on IE 11
                                        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

                                    return (sa);
                                }
                      </script>
                       <iframe id="txtArea1" style="display:none"></iframe>
                        <button id="btnExport" onclick="fnExcelReport();" class ="btn btn-primary"> EXPORT AS EXCEL FILE</button>
                        <br><br>
  
                 
                      <table id = "table" class ="table table-responsive " >
                            <tr style ="background-color:black; color:white;">
                                <th>Transaction ID</th>
                                <th>Transaction Date</th>
                                <th>Transaction Time</th>
                                <th>Cashier Name</th>
                                <th>PRODUCTS</th>
                                <th>Total</th>
                                
                            </tr>
                            <?php 
                            if (!empty ($_POST['transaction_date']))
                            {
                                $transaction_date = $_POST['transaction_date'];
                            }
                            
                            
                            $count = 0;
                                                        

                            $sqlViewC = "SELECT * from transaction_tbl  ";
                            $resultViewC = $conn->query($sqlViewC); 
                                if ($resultViewC->num_rows > 0) {
                                while($row = $resultViewC->fetch_assoc()) {
                                    $count++;
                                }
                                }
                            $items_per_page = 50;


                            $total_pages = ceil($count/$items_per_page);
                            if (isset ($_GET['page']) && !empty ($_GET['page']))
                            {
                            $page = $_GET['page'];
                            } 
                            else 

                            $page = 1;
                            $offset = ($page-1) *$items_per_page;   
                   
                            if (isset($_POST['search_date']))
                            {     
                                if (empty($_POST['transaction_date']))
                                {   
                                    date_default_timezone_set("Asia/Manila");    
                                    $date = date('Y-m-d');
                                   
                                }
                                else 
                                {
                                    $date =  $_POST['transaction_date'];
                                }
                               
                          
                                $sql = "select  * from transaction_tbl  where  transaction_date = '$date' order by transaction_id desc  ";
                            }
                            else
                            {
                                $sql = "select  * from transaction_tbl   order by transaction_id desc  limit $items_per_page offset $offset ;";
                            }
                               
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                              ?>
                            <tr>
                                <td><?php
                                $id = $row['transaction_date'];
                                $id_date = date('Y');
                                echo  $id_date .$row['transaction_id']; ?></td>
                                <td><?php echo $row['transaction_date']; ?></td>
                                <td><?php echo $row['transaction_time']; ?></td>
                                <td><?php echo $row['account_id']; ?></td>
                                <td>
                                        <?php
                                        $trans =  $row['transaction_id'];
                                        $sql2 = "select  * from product_in_transaction   where transaction_id = $trans
                                         order by transaction_id desc;";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            while($row2 = $result2->fetch_assoc()) {
                                              
                                                echo  $row2['quantity'] ." ".$row2['product_name'] ;
                                                echo "<br>";
                                            
                                            }
                                        } else {
                                        echo "0 results";
                                        }
                                        ?>
                                
                                </td>
                                <td><?php echo $row['total']; ?></td>
                            </tr>
                            <?php
                                    }
                                } else {
                                echo "0 results";
                                }
                            ?>
                        </table>
                        <?php 
                                     echo '<div class ="pagination" style="margin:10px 10px 10px 10px; 
                                     margin: auto;
                                     width: 100%; float :left;
                                     
                                     padding: 10px;">';?>
                                  
                                      <?php
                                      if (isset($_POST['search_date']))
                                      {

                                      }
                                      else
                                      {
                                        for ($i = 1; $i <= $total_pages; $i++)
                                        {
                                            if ($i == $page)
                                            {
                                                echo '<a class="active btn btn-default" style="background-color:orange; color:white" >'.$i .'</a>';
                                            }
                                            else 
                                            {
                                              echo '<a class ="btn btn-default" style="background-color:grey; color:white" href = "transactionHistory.php?page=' .$i .'">' .$i .'</a>';
                                            }
                                        }
      
                                        echo '</div>';
                                      }
                                    
                                  ?>
                         
                         
                    </div>
                </div>
               
            </div>
            </div>
     
        </div>
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