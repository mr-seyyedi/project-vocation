<?php
    require_once "db.php";
$id=$_GET['id'];
$stmt = $db->prepare("UPDATE `vocations` SET `status` = :yes WHERE id = :id");
$stmt->bindvalue('yes' , 2);
$stmt->bindvalue('id' , $id);
$stmt->execute();
header("Location:adminpanel.php");