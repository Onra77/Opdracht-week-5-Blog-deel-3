<div id=user>
    <?php if(isset($_SESSION['username'])) { ?> 
        <input type="button" value="Logout" onclick="logout();">
        <!--<?php echo $_SESSION['username']; ?> &nbsp-->
        <input type="button" value="Nieuwe bericht" onclick="location.href='post.php';">
        <input type="button" value="Nieuwe onderwerp" onclick="location.href='subject.php';">
        <input type="button" value="Home" onclick="location.href='index.php';">&nbsp&nbsp&nbsp
        <span><b>Welkom terug <?php echo $_SESSION['username']; ?>!</b></span>&nbsp&nbsp&nbsp&nbsp
        <span><b>R&M blog</b></span> 
    <?php 
        //true al ingelogd
        } else{
    ?>
        <input type="button" value="Login" onclick="login();">
        <input type="button" value="Registeer" onclick="location.href='register.php';">
        <input type="button" value="Home" onclick="location.href='index.php';">&nbsp&nbsp&nbsp
        <span><b>Welkom op R&M blog</b></span>
    <?php } ?>

    <form action "index.php" method="post">
        <?php
        $sql = "SELECT * FROM categories ORDER BY id ASC";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if(mysqli_num_rows($res) >0) {
            while($row = mysqli_fetch_assoc($res)) {
                $tagid = $row['id'];
                echo "<input type='radio' name='cats' value='$tagid'  />";
                echo $row['category'];
                echo $tagid;
            }
        } else { 
                echo "Geen categorieën.";
        }
        ?>
        <input name="post" type="submit" value="Filter">
    </form>   
</div>

<script>
    function login() {
        location.href = "login.php";
    }
    function logout() {
        location.href = "logout.php";
    }
</script>














           
