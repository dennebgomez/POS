
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
             
                    <h4 class="card-title"  id="heading-multiple-thumbnails">SALES REPORT PER PRODUCT</h4>
                
                  
                </div>
                <div class="card-content">
                
                    <div class="card-body" >
                    <center>
                    <form action= "admin.php" method="POST" style ="  float:left;">
                            <label for="transaction_date"><b>SALES PER DAY </b> </label> <br> 
                            <input type="date" id="transaction_date"  name="transaction_date">
                            <input type="submit" name="search_date" value ="SEARCH"  style ="background-color:orange; color:white; " class = "btn btn-default">
                    </form>
                    <br><br><br><br><br>
                    <form action= "admin.php" method="POST" style ="  float:left;">
                            <label for="transaction_date"><b>SALES PER MONTH </b> </label>
                            <br> 
                            <input type="month"  value="<?=date('Y-m')?>" id="transaction_date" name="transaction_month">
                            <input type="submit" name="search_month" value ="SEARCH"  style ="background-color:orange; color:white; " class = "btn btn-default">
                    </form>
                    <br><br><br><br><br>
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
                                <h1>  
                                    <?php
                                        if (isset($_POST['search_date']) )
                                        {   
                                            if (!empty($_POST['transaction_date']))
                                            {
                                                $asd =  $_POST['transaction_date'];
                                                echo "SALES ON " .date('F  d, Y ', strtotime($asd)); 
                                            }
                                            
                                            
                                        }
                                        else if (isset($_POST['search_month']))
                                        {
                                            if (!empty($_POST['transaction_month']))
                                            {
                                                $asd =  $_POST['transaction_month'];
                                                echo "SALES ON " .date('F, Y', strtotime($asd)); 
                                            }
                                        }
                                        else 
                                        {
                                            echo "ALL TIME SALES";
                                        }

                                    ?>
                                </h1>
                            <tr style ="background-color:black; color:white;">
                                <th>Product ID</th>
                                <th>Product Name</th>
                             
                            
                                <th>Sales </th>
                                <th>Total </th>
                            
                            
                                
                            </tr>
                            <?php 
                            if (!empty ($_POST['transaction_date']))
                            {
                                $transaction_date = $_POST['transaction_date'];
                            }
                            
                            
                           
                            //date per day
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
                               
                              
                                $sql = "select  * ,  count(*) as count_sale   from product_in_transaction  where date like '%$date%' group by  product_name order by transaction_id desc  ;";
                            }
                           
                               // month
                            else  if (isset($_POST['search_month']))
                            {     
                                if (empty($_POST['transaction_month']))
                                {   
                                    date_default_timezone_set("Asia/Manila");    
                                    $date = date('Y-m');
                                   
                                }
                                else 
                                {
                                    $date =  $_POST['transaction_month'];
                                }
                               
                              
                                $sql = "select  * ,  count(*) as count_sale   from product_in_transaction  where date like '%$date%' group by  product_name order by transaction_id desc  ;";
                            }
                            else
                            {
                                $sql = "select  * ,  count(*) as count_sale   from product_in_transaction   group by  product_name order by transaction_id desc  ;";
                            }
                              
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                              ?>
                            <tr>
                                <td><?php echo $row['product_id']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                
                                <td><?php
                                    $id = $row['product_id'];
                                        //date per day inside loop 
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
                                        
                                            $sql2 = "select sum(quantity)total_sales from product_in_transaction where product_id=$id and date = '$date';";
                                        }
                                       
                                            // month inside loop
                                        else  if (isset($_POST['search_month']))
                                        {     
                                            if (empty($_POST['transaction_month']))
                                            {   
                                                date_default_timezone_set("Asia/Manila");    
                                                $date = date('Y-m');
                                            
                                            }
                                            else 
                                            {
                                                $date =  $_POST['transaction_month'];
                                            }
                                            $sql2 = "select sum(quantity)total_sales from product_in_transaction where product_id=$id and date  like '%$date%' ;";
                                        }
                                        else
                                        {
                                            $sql2 = "select sum(quantity)total_sales from product_in_transaction where product_id=$id ;";
                                        }
                                   
                                    $result2 = $conn->query($sql2);
                                    if ($result2->num_rows > 0) {
                                        while($row2 = $result2->fetch_assoc()) {   
                                            if ($row2['total_sales'] == "")
                                            {
                                                echo "0";
                                            }
                                            else 
                                            {
                                                echo $row2['total_sales'];
                                            }
                                         
                                            $total_qty = $row2['total_sales'];
                                        }
                                    }
                                   
                                 ?></td>
                                <td><?php
                               $total =  $row['product_price'] *  $total_qty;
                                echo  $total; ?></td>
     
                            </tr>
                            <?php
                                    }
                                } else {
                                echo "0 Sales";
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