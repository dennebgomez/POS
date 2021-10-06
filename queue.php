
<!DOCTYPE html>
 <?php include ("connectionDB.php"); ?>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     
     
    <title>QUEUE</title>
  
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/vendors/css/charts/chartist.css">
 
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/app-lite.css">
  
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="admin assests/theme-assets/css/pages/dashboard-ecommerce.css">
    <style>
    
        * {
            font-size:5vh;
        }
         
     
   
    </style>
  </head>
 
  <body  >
  <script type = "text/javascript" >
  
    function loadDoc() {
        setInterval(function(){
            var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML = this.responseText;
        
        }
    };
    xhttp.open("GET", "queue.php", true);
    xhttp.send();
       
        },1000);
            

      
    }
    loadDoc();

    $("td").each(function() {
    if (this.innerText === '') {
    	this.closest('tr').remove();
    }
});
</script>

    <div class="container-fluid" style ="width:100%; " id ="demo" >
     <div class="row" style ="width:100%; " >
        <div class="col-sm-2" style ="background-color: red; ">
                <table style ="width:100%;"  >
                <tr >
                    <th style ="width: 100%; background-color:red; color:white; font-size:30px;">PREPARING</th>
                    <th></th>
                  
 
                </tr>
                <?php 
                
                    $sql = "Select * from order_tbl where status  = 'PREPARING'  limit 10 offset  0";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                    // output data of each row
                        $count = 0;
                    while($row = $result->fetch_assoc()) {
                     
                  
                ?>
                <?php
                
                ?>
                <tr>     
                            <td  style ="background-color:red; color:white;"> <?php echo $row['order_id']; ?>
                            </td>
                 
                </tr>
                <?php
                    }
                    } else {
                    
                    }
                ?>   

                
                </table>
        </div>
        <div class="col-sm-2" style ="background-color: red; ">
                <table style ="width:100%;"  >
                <tr >
                    <th style ="width: 100%; float :left; background-color:red; color:white;"> _  </th>
                    <th></th>
                  
 
                </tr>
                <?php 
                
                    $sql = "Select * from order_tbl where status  = 'PREPARING'  limit 10 offset  10";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                    // output data of each row
                        $count = 0;
                    while($row = $result->fetch_assoc()) {
                     
                  
                ?>
                <?php
                
                ?>
                <tr>     
                            <td  style ="background-color:red; color:white;"> <?php echo $row['order_id']; ?>
                            </td>
                 
                </tr>
                <?php
                    }
                    } else {
                    
                    }
                ?>   

                
                </table>
        </div>
        <div class="col-sm-2" style ="background-color: red; ">
                <table style ="width:100%;"  >
                <tr >
                    <th style ="   background-color:red; color:white;"> _</th>
                    <th></th>
                  
 
                </tr>
                <?php 
                
                    $sql = "Select * from order_tbl where status  = 'PREPARING'  limit 10 offset  20";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                    // output data of each row
                        $count = 0;
                    while($row = $result->fetch_assoc()) {
                     
                  
                ?>
                <?php
                
                ?>
                <tr>     
                            <td  style ="background-color:red; color:white;"> <?php echo $row['order_id']; ?>
                            </td>
                 
                </tr>
                <?php
                    }
                    } else {
                    
                    }
                ?>   

                
                </table>
        </div>

        <div class="col-sm-2" style ="background-color: green; ">
                <table style ="width:100%; ">
                <tr >
           
                    <th style ="width:100%; background-color:green; color:white;  font-size:30px;">PLEASE COLLECT</th>
                </tr>
                <?php 
                    $sql2 = "Select * from order_tbl where status  = 'PLEASE COLLECT' limit 10 offset 0";
                    $result2 = $conn->query($sql2);
                    
                    if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row2 = $result2->fetch_assoc()) {
                        
                    
                ?>
                <tr>
                    <td style ="background-color:green; color:white;"> <?php echo $row2['order_id']; ?>
                    </td>
                  
                </tr>
                <?php
                    }
                    } else {
                    
                    }
                ?>   
                </table>
        </div>
        <div class="col-sm-2" style ="background-color: green; ">
                <table style ="width:100%; ">
                <tr >
           
                    <th style ="width:100%; background-color:green; color:white;  font-size:30px;">_</th>
                </tr>
                <?php 
                    $sql2 = "Select * from order_tbl where status  = 'PLEASE COLLECT' limit 10 offset 10";
                    $result2 = $conn->query($sql2);
                    
                    if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row2 = $result2->fetch_assoc()) {
                        
                    
                ?>
                <tr>
                    <td style ="background-color:green; color:white;"> <?php echo $row2['order_id']; ?>
                    </td>
                  
                </tr>
                <?php
                    }
                    } else {
                    
                    }
                ?>   
                </table>
        </div>
        <div class="col-sm-2" style ="background-color: green; ">
                <table style ="width:100%; ">
                <tr >
           
                    <th style ="width:100%; background-color:green; color:white;  font-size:30px;">_</th>
                </tr>
                <?php 
                    $sql2 = "Select * from order_tbl where status  = 'PLEASE COLLECT' limit 10 offset 20";
                    $result2 = $conn->query($sql2);
                    
                    if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row2 = $result2->fetch_assoc()) {
                        
                    
                ?>
                <tr>
                    <td style ="background-color:green; color:white;"> <?php echo $row2['order_id']; ?>
                    </td>
                  
                </tr>
                <?php
                    }
                    } else {
                    
                    }
                ?>   
                </table>
        </div>             

     </div>
    
    </div>
  
 
 
 
    <script src="admin assests/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <script src="admin assests/theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
 
  </body>
  
</html>