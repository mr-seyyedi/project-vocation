<?php 
require_once "db.php";
if (isset ($_POST['vocation'])){ header("Location:vacation.php"); }
if (isset ($_POST['logaut'])){ header("Location:logaut.php"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <title>index</title>
</head>
<body>
<?php
    if (isset ($_SESSION['user'])){
        $username=$_SESSION['user'];
        $stmt  =  $db->prepare("SELECT * FROM `users` WHERE `username` = :username");
        $stmt->bindvalue("username","$username");
        $stmt->execute();
        foreach ($stmt as $row){
            $name=$row['name'];
            $family=$row['family'];
?>
    <div style='
    background-color:#00ff60;
    text-align:center;
    padding:10px;
    '>
    <h1><?php echo "$name $family"; ?></h1>
    <hr>
    <form method="POST">
    <button type="submit" class="btn btn-outline-secondary" name="logaut">خروج</button>
    <button type="submit" class="btn btn-secondary" name="vocation">مرخصی</button>
    </form>
    <hr>
    </div>
<?php } } ?>

<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>