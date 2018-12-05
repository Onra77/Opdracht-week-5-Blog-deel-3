<?php
include 'header.php';
 session_start();
    include_once("db.php");

      // Als je niet ingelogd bent wordt je naar login.php gestuurd.
    //echo $_SESSION['username']; 
    if(!isset($_SESSION['username'])) {
        //true al ingelogd
        header("location:login.php");
            } else{

if(!isset($_GET['pid'])) {
    header("location: login.php");
} else {
    $pid = $_GET['pid'];
    $sql = "DELETE FROM post WHERE id=$pid";
    mysqli_query($db, $sql);
    header ("location: index.php");
}
}

?>