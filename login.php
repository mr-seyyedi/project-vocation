<?php 
require_once "db.php";
// form login
if (isset($_POST['login'])){
	if (empty ($_POST['username'])){
		echo("<script>alert('null username!! ')</script>");
	}
  elseif(empty($_POST['pass'])){
    echo("<script>alert('null password!! ')</script>");
  }
  else{
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $stmt  =  $db->prepare("SELECT * FROM `users` WHERE `username` = :username AND `password` = :pass");
    $stmt->bindvalue("username","$username");
    $stmt->bindvalue("pass","$pass");
    $stmt->execute();
    $login=$stmt->rowCount();
    if($login > 0){
      $_SESSION['user']=$username;
      header("Location:vacation.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <link rel = "stylesheet" href = "asset/css/bootstrap.min.css">
    <title>login page</title>
</head>
<body style = "
    text-align: center;
    margin: 200px 0px 0px 640px;
    ">
       
    <div class = "row">
    <form method="POST">
    <h3>ورود به سامانه </h3><hr>
        <div class = "form-group">
          <label for = "exampleInputEmail1">نام کاربری</label>
          <input type = "text" class = "form-control" placeholder = "Enter username" name = "username">
        </div>
        <div class = "form-group">
          <label for = "exampleInputPassword1">پسورد</label>
          <input type = "password" class = "form-control" placeholder = "Enter password" name = "pass">
        </div>
  <button type = "submit" class = "btn btn-primary col-sm-12" name = "login">ورود</button>
</form>
    </div>


<script src = "asset/js/jquery.min.js"></script>
<script src = "asset/js/bootstrap.min.js"></script>
<script src = "asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>