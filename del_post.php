<?php
include 'header.php';
 session_start();
    include_once("db.php");

if(!isset($_GET['pid'])) {
    header("location: login.php");
} else {
    $pid = $_GET['pid'];
    $sql = "DELETE FROM post WHERE id=$pid";
    mysqli_query($db, $sql);
    header ("location: index.php");
}
?>