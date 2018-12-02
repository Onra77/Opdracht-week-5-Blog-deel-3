<!-- Als je niet ingelogd bent wordt je naar inlog.php gestuurd. -->
<?php
if(isset($_GET['pid'])) {
        header("location: login.php");
    }  else {}
?>