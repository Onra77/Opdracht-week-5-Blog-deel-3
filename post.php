<?php
    include 'header.php';

    // Als je niet ingelogd bent wordt je naar login.php gestuurd.
    //echo $_SESSION['username']; 
    if(!isset($_SESSION['username'])) {
        //true al ingelogd
        header("location:login.php");
    } else{
        // zodat de value (om de waarde te behouden na foutmelding) in form niet als tekst wordt geprint.
        $title = '';
        $content = '';
        
        // Invoeren van tekst en titel voor de blog.
        if(isset($_POST['post'])) {
        $title = strip_tags($_POST['title']);
        $title = mysqli_real_escape_string($db, $title);
        $content = strip_tags($_POST['content']); 
        $content = mysqli_real_escape_string($db, $content);
        $author = strip_tags($_SESSION['username']);
        $cats = strip_tags($_POST['cats']);
        $captcha = strip_tags($_POST['captcha']); 
        $code = $_POST['cap'];
        $sql =  "INSERT into post (title, content, author, cat_id) VALUES ('$title', '$content', '$author', '$cats')";
            if($title == "" || $content == "" || $author == "id" || $captcha != $code || $captcha == "") {
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
    <title>Nieuwe bericht - R&M blog</title>
</head>

<body id=form>
    <form action="post.php" method="post" enctype="multipart/form-data">
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
        ?> 
        <br/><br/>
        <input placeholder="Title" name="title" type="text" autofocus size="48" value="<?php echo $title; ?>"><br/><br/>
        <textarea placeholder="Content" name="content" rows="20" cols="50"><?php echo $content; ?></textarea><br/><br/>
        <input name="post" type="submit" value="Post">
        <input name="reset" type="reset" value="Reset">
        <input type="button" value="Terug" onclick="location.href='index.php';"><br/><br/>
        <?php echo $cap = (rand(100,1000)); ?>
        <input placeholder="Wat is de code?" type="text" name="captcha">
        <input type="hidden" name="cap" value="<?php echo $cap;?>">
    </form>
    
</body>    
</html>