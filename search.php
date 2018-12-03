<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysqli_connect("localhost","root","","blog2");
    $query=mysqli_query($con, "SELECT * FROM post WHERE content LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['content'];
    }
    echo json_encode($array);
    mysqli_close($con);
?>