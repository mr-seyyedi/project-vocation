<?php 
    require_once "db.php";
    if (isset ($_POST['vocation'])){ header("Location:vacation.php"); }
    if (isset ($_POST['logaut'])){ 
      unset($_SESSION['admin']);
      header("Location:login.php");
     }
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <link rel = "stylesheet" href = "asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <title>index</title>
</head>
<body style = "text-align: center;">
<div style = '
    background-color:#abffcb;
    text-align:center;
    padding:10px;
    '>
    <h1>خوش امدید مدیر</h1>
    <hr>
    <form method = "POST">
    <button type = "submit" class = "btn btn-outline-secondary" name = "logaut">خروج</button>
    </form>
    <hr>
</div>
<div class="container-fluid">
<h2>لیست مرخصی ها</h2>
<?php
        $stmt = $db->prepare("SELECT * FROM `vocations`");
        $stmt->execute();
        $row = $stmt->fetchAll();
        $array = count($row);
        if ($array <= 0){
          echo "<br><h3 style='background-color:gray;'>مرخصی ثبت نشده است</h3>";
        }
        else{
?>
    <div class="table">
      <table style="width:100%">
        <thead>
        <tr>
          <td>رذ / تایید</td>
          <td>نام</td>
          <td>تاریخ</td>
          <td>زمان</td>
          <td>شرح</td>
          <td>وضعیت</td>
        </tr>
        </thead>  
        <?php 
        $id = $_SESSION['userid'];
        $stmt   =   $db->prepare("SELECT * FROM `vocations`");
        $stmt->execute();
        $row=$stmt->fetchAll();
        foreach ($row as $row){
          if ($row['status']==0){
            $status= "درحال انتظار";
            $color="#fff";
          }
          if ($row['status']==1){
            $status= "مشاهده شده";
            $color="gray";
          }
          elseif ($row['status']==2){
            $status= "تایید شده";
            $color="#90EE90";
          }
          elseif ($row['status']==3){
            $status= "رد شده";
            $color="#de2a2a";
          }
          $id=$row['userid'];
          $stmt = $db->prepare("SELECT `name`, `family` FROM `users` WHERE id = :id");
          $stmt->bindvalue('id',$id);
          $stmt->execute();
          $users=$stmt->fetch();
          $name=$users['name'];
          $family=$users['family'];
          ?>
      <tbody>
        <tr  style="background-color:<?php echo $color; ?>">
          <td>
          <a href="yes.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm btn-lg active" role="button" aria-pressed="true">تایید</a>
          <a href="no.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm btn-lg active" role="button" aria-pressed="true">رد</a>
          
          </td>
          <td><?php echo "$name $family" ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['time'] ?></td>
          <td><?php echo $row['desc'] ?></td>
          <td><?php echo $status ?></td>
        <?php }} ?>
        </tr>
        </tbody>
      </table>
    </div>
<hr>
</div>
<script src = "asset/js/jquery.min.js"></script>
<script src = "asset/js/bootstrap.min.js"></script>
<script src = "asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>