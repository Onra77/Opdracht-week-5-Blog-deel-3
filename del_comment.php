<?php
include 'header.php';
 
    include_once("db.php");

if(!isset($_GET['com_id'])) {
    header("location: login.php");
} else {
    $com_id = $_GET['com_id'];
    $pid = $_GET['pid'];
    $sql = "DELETE FROM comments WHERE com_id=$com_id";
    mysqli_query($db, $sql);
    header ("location: index.php?pid=$pid");
  
    
}
?>