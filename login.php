<?php
include_once("db.php");
session_start();

// als je a ingelogd bent ga je terug naar index.php.
//echo $_SESSION['username']; 
if(isset($_SESSION['username'])) {
//true al ingelogd
header("location:index.php");
    } else {
    if (isset($_POST['submit']))  { 
    //$username = $_POST['username'];
    $username = mysqli_real_escape_string($db, ($_POST['username']));
    $password = $_POST['password'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM login WHERE username ='$username' AND password ='$password'";
    $result = mysqli_query($db, $sql);
    echo $count = mysqli_num_rows($result);
    if($count == 1){
        $_SESSION['username'] = $username;
        header("location:index.php");
    } else {
        $fmsg = "Ongeldig gebruiker/wachtwoord";
        }
    }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>    

<body>
    <div class="container">
        <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"><?php echo $smsg; ?></div>} <?php } ?>
        <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"><?php echo $fmsg; ?></div> <?php } ?>
         <form class="form-signing" method="POST">
             <h2 class="form-signin-heading">Login</h2>
             <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam" required>
             <label for="inputPassword" class="sr-only">Wachtwoord</label>
             <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Wachtwoord vereist!">
             <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Login"><br>
             <a class="btn btn-lg btn-primary btn-block" href="register.php">Registeer</a>
             <a class="btn btn-lg btn-primary btn-block" href="index.php">Home</a>
            </form>
    </div>
</body>
<?php include 'footer.php';?>
</html>