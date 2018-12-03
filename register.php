<?php
include_once("db.php");
session_start();

// als je a ingelogd bent ga je terug naar index.php.
//echo $_SESSION['username'];
if(isset($_SESSION['username'])) {
//true al ingelogd
header("location:index.php");
    } else{

    if(isset($_POST) & !empty($_POST)){
    //if(isset($_POST['submit']))  { 
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO login (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($db, $sql);
    if($result){
        $smsg = "Gebruiker succesvol geregisteerd.";
        header("location:login.php");
    }else{
        $fsmg = "Registratie mislukt.";
    }
    }
}
?>

<!DOCTYPE html> 
<html>
<head>
    <title>Registreren</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-latest.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <form class="form-signing" method="POST">
            <h2 class="form-signin-heading">Registreren</h2>
            <input type="text"name="username" class="form-control" placeholder="Gebruikersnaam" required>
            <label for="inputEmail" class="sr-only">Email adress</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Wachtwoord</label>
            <input type="password" name="password" id="inputPasword" class="form-control" placeholder="Wachtwoord vereist">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Registreer</button><br>
            <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
            <a class="btn btn-lg btn-primary btn-block" href="index.php">Home</a>
        </form>
    </div>
</body>
</html>