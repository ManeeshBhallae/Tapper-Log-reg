<?php
session_start();

include("connection.php");
include("function.php");

$user_data=check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My webpage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="indexDiv">
    <?php
    $name=$user_data['username'];
    $name=substr($name,0,strpos($name,"@")); 
    ?>
     <h2 class="h">Hello,<?php echo strtoupper($name);?>.</h2>
<hr>
<br>
    <a id="logoutBtn" href="logout.php">LogOut</a>


    
</div>

</body>


</html>


       


