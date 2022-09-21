<?php 
    require_once "db.php";
    if (isset ($_POST['vocation'])){ header("Location:vacation.php"); }
    if (isset ($_POST['logaut'])){ header("Location:logaut.php"); }
    if (isset ($_POST['save'])){
      if (empty ($_POST['date'])){
        echo("<script>alert('null date!! ')</script>");
      }
      elseif(empty($_POST['time'])){
        echo("<script>alert('null time!! ')</script>");
      }
      elseif(empty($_POST['desc'])){
        echo("<script>alert('null desc!! ')</script>");
      }
      else{
        
        $id=$_SESSION['userid'];
        $date=$_POST['date'];
        $time=$_POST['time'];
        $desc=$_POST['desc'];
        $sql="INSERT INTO `vocations`(`date`, `desc`, `time`, `userid`) VALUES ( ? , ? , ? , ?)";
        $stmt=$db->prepare($sql);
        $stmt->bindvalue(1 , $date);
        $stmt->bindvalue(2 , $desc);
        $stmt->bindvalue(3 , $time);
        $stmt->bindvalue(4 , $id);
        $stmt->execute();
        echo("<script>alert('save ok!! ')</script>");
      }
    }

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
<body style="text-align: center;">
<?php
    if (isset ($_SESSION['user'])){
        $username=$_SESSION['user'];
        $stmt  =  $db->prepare("SELECT * FROM `users` WHERE `username` = :username");
        $stmt->bindvalue("username","$username");
        $stmt->execute();
        foreach ($stmt as $row){
            $id=$row['id'];
            $_SESSION['userid']=$id;
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
<h2>لیست مرخصی ها</h2>
<hr>
<h2>ثبت مرخصی ها</h2>
<br><br>

<form action="#" method="POST">
  <div class="form-group">
  <div class="form-row">
    <div class="col">
      <label for="date"><b>تاریخ</b></label>
      <input type="text" class="form-control" id="date" name="date" value="<?php print date("Y/m/d") ?>">
    </div>
    <div class="col">
      <label for="time"><b>زمان</b></label>
      <select class="form-control" id="time" name="time">
        <option value="1day">یک روزه</option>
        <option value="2day">دو روزه</option>
        <option value="3day">سه روزه</option>
        <option value="4day">چهار روزه</option>
      </select>
    </div>
  </div>
  </div>
  <div class="form-group">
    <label for="desc"><b>شرح</b></label>
    <textarea class="form-control" id="desc" rows="4" name="desc"></textarea>
  </div>
  <button type="submit" class="btn btn-secondary btn-lg btn-block" name="save">ذخیره</button>
</form>







<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>