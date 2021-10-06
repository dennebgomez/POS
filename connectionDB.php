<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos";
 
 
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button >asd</button>
<button name ="">try</button>
<script src = "jqueries/sweetalert.min.js"></script>
<script src = "jqueries/script.js"></script>

    
</body>
</html> -->
