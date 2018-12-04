<?php
    $x = 0;
  if(isset($_POST['cats'])) {
    $x = $_POST['cats'];
  }
  if(isset($_POST['reset'])) {
    $sql = "SELECT * FROM post ORDER BY id DESC";
  }
?>

<div id=blog>
    <?php
        require_once("nbbc.php");
        $bbcode = new BBCode;
        
        if($x <= 1) {
            $sql = "SELECT *, DATE_FORMAT(date, '%D %M %Y om %H:%i') as date_formatted FROM post ORDER BY date DESC";
        } else {
            $sql = "SELECT *, DATE_FORMAT(date, '%D %M %Y om %H:%i') as date_formatted FROM post WHERE cat_id='$x' ORDER BY date DESC";       
        }
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        $post ="";
        // Geeft verschillende knoppen als je ingelog bent of niet.   
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            //true al ingelogd
            if(mysqli_num_rows($res) >0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $author = $row['author'];
                    $cats = $row['cat_id'];
                    $date = $row['date_formatted'];
                    ?><div id=change><?php    
                    $admin = "<div><a href='del_post.php?pid=$id'>Verwijder</a>&nbsp;<a href='edit_post.php?pid=$id'>Wijzig</a>&nbsp</div>";
                    ?></div><?php    
                    $output = $bbcode->Parse($content);
                    $post = "<div><a href='index.php?pid=$id'/><b>$title<?b<b>$author</b>&nbsp&nbsp$date&nbsp&nbsp<b>$cats</b>$admin</div>";
                    echo $post;
                }
            } else { 
                    ?><br/><?php  echo "Er zijn geen berichten uit die categorie.";
            }
        } else if(mysqli_num_rows($res) >0) {
            while($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $content = $row['content'];
                $date = $row['date_formatted'];
                $output = $bbcode->Parse($content);
                $post = "<div><a href='index.php?pid=$id'/><b>$title<?b></a>&nbsp&nbsp&nbsp<b>$date</b><p></div>";
                echo $post;
            } 
        }
    ?>
</div>        
<script>
    $(function() {
    var fixed = document.getElementById('blog'), overflow;
    $(window).on('load resize', function() {
    overflow = fixed.scrollHeight-$('#fixed').height();
    });
    fixed.on('touchmove', function() {
    if (overflow) return true;
    else return false;
    });
</script>