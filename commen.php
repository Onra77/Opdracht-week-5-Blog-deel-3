<?php
    include 'header.php';
   
    // Als je niet ingelogd bent wordt naar login.php gestuurd.
    //echo $_SESSION['username']; 
    if(!isset($_SESSION['username'])) {
        //true al ingelogd
        header("location:login.php");
            } else{

    // zodat de value (om de waarde te behouden na foutmelding) in form niet als tekst wordt geprint.
    $category = '';
       
    if(isset($_POST['submit'])) {
        $comment = strip_tags($_POST['comment']);
        $comment = mysqli_real_escape_string($db, $comment);
        $author = strip_tags($_SESSION['username']);
        $captcha = strip_tags($_POST['captcha']); 
        $code = $_POST['cap'];
        $sql =  "INSERT into categories (category, author) VALUES ('$comment', '$author')";
           if($category == "") {
            echo "De onderwerp is niet ingevuld!";
            }
            else {
                mysqli_query($db, $sql);
                header("Location: index.php");
            }   
      }
    }
?>

<!DOCTYPE html>
<html>
<head>
     <title>Commentaar - R&M blog</title>
</head>

<body id=form>
    <!--<?php echo $_SESSION['username']; ?> -->
    <form action="subject.php" method="post" enctype="multipart/form-data"><br/>
        <input placeholder="Voer nieuwe onderwerp in" name="comment" type="text" autofocus size="48" value="<?php echo $category; ?>"><br/><br/>
        <input name="submit" type="submit" value="Post">
        <input name="reset" type="reset" value="Reset">
        <input type="button" value="Terug" onclick="location.href='index.php';"><br/><br/>
        <?php echo $cap = (rand(100,1000)); ?>
        <input placeholder="Wat is de code?" type="text" name="captcha">
        <input type="hidden" name="cap" value="<?php echo $cap;?>">
    </form>
    
</body>
<?php include 'footer.php';?>    
</html>