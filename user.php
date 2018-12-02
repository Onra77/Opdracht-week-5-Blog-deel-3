<div id=user>
            <?php if(isset($_SESSION['username'])) { ?> 
                <input type="button" value="Logout" onclick="logout();">
                <!--<?php echo $_SESSION['username']; ?> &nbsp-->
                <input type="button" value="Nieuwe bericht" onclick="location.href='post.php';">
                <input type="button" value="Nieuwe onderwerp" onclick="location.href='subject.php';">&nbsp&nbsp&nbsp
                <span><b>Welkom terug <?php echo $_SESSION['username']; ?>,</b></span>
                <span><b align="right">R&M blog</b></span>
                
                

            <?php 
                //true al ingelogd
                } else{
            ?>
                <input type="button" value="Login" onclick="login();">
                <input type="button" value="Registeer" onclick="location.href='register.php';">
                <span><b>Welkom op R&M blog</b></span>
            <?php } ?>
           
        </div>