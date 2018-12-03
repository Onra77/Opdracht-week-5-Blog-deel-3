<?php
    include 'header.php';

    // Als je niet ingelogd bent wordt je naar login.php gestuurd.
    //echo $_SESSION['username']; 
    if(!isset($_SESSION['username'])) {
        //true al ingelogd
        header("location:login.php");
            } else{
    // wijzigen van blog teksten en titles.
    $pid = $_GET['pid'];
    if(isset($_POST['update'])) {
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);
        $title = mysqli_real_escape_string($db, $title);
        $content = mysqli_real_escape_string($db, $content);
        $author = strip_tags($_SESSION['username']);
        //$author = mysqli_real_escape_string($db, $author);
        $captcha = strip_tags($_POST['captcha']); 
        $code = $_POST['cap'];
        $sql =  "UPDATE post SET title='$title',content='$content'WHERE id=$pid";
        if($title == "" || $content == "" || $author == "id" || $captcha != $code || $captcha == "") {
            echo "De post is niet compleet ingevuld!";
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
    <title>Wijzig bericht - R&M blog</title>
</head>

<body id=form>
    <?php
        // De categorieën
        $sql = "SELECT * FROM categories ORDER BY id ASC";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if(mysqli_num_rows($res) >0) {
        while($row = mysqli_fetch_assoc($res)) {
            $tagid = $row['id']; ?>
            <!-- is $_POST['cats'] gelijk aan de tagid echo dan checked -->
            <input type='radio' name= 'cats' <?php echo $tagid; ?> value='<?php echo $tagid ?>'/>
            <?php echo $row['category'];
            }
            }else {echo "Geen categorieën.";
            }

        $sql_get ="SELECT * FROM post WHERE id=$pid LIMIT 1";
        $res = mysqli_query($db, $sql_get);
        if(mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $title =$row['title'];
                $content = $row['content'];
                    echo "<form action='edit_post.php?pid=$pid' method='post' enctype='multipart/form-data'><br/>";
                    echo "<input placeholder='Title' name='title' type='text' value='$title' autofocus size='48'><br/><br/>";
                    echo "<textarea placeholder='Content' name='content' rows='20' cols='50'>$content</textarea><br/><br/>";
                }
        }
    ?>
        <input name="update" type="submit" value="Update">
        <input name="reset" type="reset" value="Reset">
        <input type="button" value="Terug" onclick="location.href='index.php';"><br/><br/>
        <?php echo $cap = (rand(100,1000)); ?>
        <input placeholder="Wat is de code?" type="text" name="captcha">
        <input type="hidden" name="cap" value="<?php echo $cap;?>">

        
</body>
<?php include 'footer.php';?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
</html>