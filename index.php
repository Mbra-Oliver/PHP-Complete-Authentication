<?php 
    session_start();
    if(! $_SESSION['logged']){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Welcome <?= $_SESSION['name'] ?></p>    
    <p>Email: <?= $_SESSION['email'] ?></p> 
    <a href="logout.php">Me déconnecter</a>   
</body>
</html>