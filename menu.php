<div id=categories>
<form action "index.php" method="post">
    <?php
    $sql = "SELECT * FROM categories ORDER BY id ASC";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if(mysqli_num_rows($res) >0) {
        while($row = mysqli_fetch_assoc($res)) {
            $tagid = $row['id'];
            echo "<input type='radio' name='cats' value='$tagid'  />";
            echo $row['category'];
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