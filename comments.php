<?php
    
    // Als je niet ingelogd bent wordt je naar login.php gestuurd.
    //echo $_SESSION['username']; 
    if(!isset($_SESSION['username'])) {
        //true al ingelogd
        header("location:login.php");
    } else{
        // zodat de value (om de waarde te behouden na foutmelding) in form niet als tekst wordt geprint.
        $comment = '';
               
        // Invoeren van tekst en titel voor de blog in tabel comments.
        if(isset($_POST['comments'])) {
        $comment = strip_tags($_POST['comment']);
        $author = strip_tags($_SESSION['username']); 
        $post_id = strip_tags($_SESSION['pid']); 
        $captcha = strip_tags($_POST['captcha']); 
        $code = $_POST['cap'];
        $sql =  "INSERT into comments (comment, author, post_id) VALUES ('$comment', '$author', '$post_id')";
            if($comment == "" || $author == "id" || $captcha != $code || $captcha == "") {
            echo "De post is niet compleet ingevuld!";
        } else {
            mysqli_query($db, $sql);
            header("Location: index.php");
        }
        }
    }      
?>

<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
       
        <br/><br/>
        <textarea placeholder="Comment" name="comment" rows="20" cols="50"><?php echo $comment; ?></textarea><br/><br/>
        <input name="comments" type="submit" value="Post">
        <input name="reset" type="reset" value="Reset">
        <input type="button" value="Terug" onclick="location.href='index.php';"><br/><br/>
        <?php echo $cap = (rand(100,1000)); ?>
        <input placeholder="Wat is de code?" type="text" name="captcha">
        <input type="hidden" name="cap" value="<?php echo $cap;?>">
    </form>
    
</body>    
</html>