<?php include 'header.php';?>
<?php include 'user.php';?>
<?php include 'footer.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>R&M Blog</title>
    <form action="index.php" method="POST" id=search>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <input type="text" name="zoekbalk" placeholder="zoeken"><br/>
    <input name="zoek" type="submit" value="zoeken">
</form>
</head>
<body>

<div id=zoekresultaat>
    <?php
    require_once("nbbc.php");
    $bbcode = new BBCode;

    if(isset($_POST['zoek'])){
        $zoekbalk = $_POST['zoekbalk'];
        $con=mysqli_connect("localhost","root","","blog2");
        $sql = "SELECT * FROM post WHERE author LIKE '%$zoekbalk%' OR title LIKE '%$zoekbalk%'";
        $query=mysqli_query($con, $sql);
        $rowcount=mysqli_num_rows($query);
        echo "Resultaat: ";
        echo $rowcount;
        if($rowcount ==0){
            echo "<h3>Geen resultaat!</h3>";
        } else {
        while($row=mysqli_fetch_assoc($query)) {
            if(!isset($_SESSION['username'])) {
                //true al ingelogd
                ?>
                <h3><?php echo $row['title']; ?></h3>
                <?php echo $row['content']; ?>
                <?php
            } else {
                ?>
                <h3>Author: <?php echo $row['author']; ?></h3>
                <h3><?php echo $row['title']; ?></h3>
                <?php echo $row['content']; ?>
                <?php
            }  
        } 
        }
    }      
    include 'profile.html';
    ?>
    
</div>

<div id=blog>
<?php 

if(!isset($_GET['pid'])) {
    include 'blog.php';
    } else {
        $pid=$_GET['pid'];
        //sql output on pid value.

        $sql = "SELECT *, DATE_FORMAT(date, '%D %M %Y om %H:%i') as date_formatted FROM post WHERE id='$pid' ORDER BY date DESC";  
      //  $db = mysqli_connect("localhost","root", "", "blog2")
        $con=mysqli_connect("localhost","root","","blog2");
        $query=mysqli_query($con, $sql); 
        while($row = mysqli_fetch_assoc($query)) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
            $author = $row['author'];
            $cats = $row['cat_id'];
            $date = $row['date_formatted'];
            $admin = "<div><a href='del_post.php?pid=$id'>Verwijder</a>&nbsp;of&nbsp<a href='edit_post.php?pid=$id'>Wijzig</a>&nbspblog</div>";
            $output = $bbcode->Parse($content);
     
            // Geeft alleen mogelijkheid to wijzigen en verwijderen als ingelog bent.   
            if(!isset($_SESSION['username'])) {
            //true al ingelogd
      
                $post = "<div><a href='index.php?pid=$id'/><b>$title</a></b><p><b>Author:&nbsp$author&nbspCategorie:&nbsp$cats&nbsp$date&nbsp</b><p>$output<p></div>";
                echo $post;
            } else {
                $post = "<div><a href='index.php?pid=$id'/><b>$title</a></b><p><b>Author:&nbsp$author&nbspCategorie:&nbsp$cats&nbsp$date&nbsp</b><p>$output$admin<p></div>";
                echo $post;
                include 'comments.php';
            }
        }
    }
    
?>
</div>
</body>
</html>