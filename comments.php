<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
    if(isset($_GET['pid'])) {
    $sql = "SELECT * FROM post WHERE pid='$id'";
            if(mysqli_num_rows($res) >0) {
            while($row = mysqli_fetch_assoc($res)) {
                $content = $row['content'];
                $author = $row['author'];
                $cats = $row['cat_id'];
                $date = $row['date_formatted'];
                $admin = "<div><a href='del_post.php?pid=$id'>Verwijder</a>&nbsp;<a href='edit_post.php?pid=$id'>Wijzig</a>&nbsp</div>";
                $output = $bbcode->Parse($content);
                $post = "<div><h3>$title</h3><b>$author</b>&nbsp&nbsp$date<p>$output</p>$admin</div>";
                echo $post;
            } else {
                index.php;
            }
            }
    }   

?>
</body>
</html>