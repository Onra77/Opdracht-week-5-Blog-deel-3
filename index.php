<?php include 'header.php';?>
<?php include 'user.php';?>
<?php include 'footer.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>R&M Blog</title>
    <form action="index.php" method="POST" id=search>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <input type="text" name="zoekbalk" placeholder="zoeken"><br/>
    <input name="zoek" type="submit" value="zoeken">
</form>
</head>
<body>

<div id=zoekresultaat>

<?php

if(isset($_POST['zoek'])){
    $zoekbalk = $_POST['zoekbalk'];
    $con=mysqli_connect("localhost","root","","blog2");
    $sql = "SELECT * FROM post WHERE title LIKE '%$zoekbalk%'";
    $query=mysqli_query($con, $sql);
    $rowcount=mysqli_num_rows($query);
 echo $rowcount;
    if($rowcount ==0){
        echo "<h3>Geen resultaat!</h3>";
    } else {
        
        while($row=mysqli_fetch_assoc($query)) {
            
            if(!isset($_SESSION['username'])) {
                //true al ingelogd
                ?>
                <h3><?php echo $row['title']; ?></h3>
                <?php echo $row['content']; ?>
                <?php
            } else {
                ?>
                <h3>author: <?php echo $row['author']; ?></h3>
                <h3><?php echo $row['title']; ?></h3>
                <?php echo $row['content']; ?>
                <?php
            }  
        } 
    }
}      
?>
</div>


<?php 

if(!isset($_GET['pid'])) {
    include 'blog.php';
} else {

  //sql output
echo 'morty lasdjf asd; dl jsdlf asdkfl jasdfasdj fklsdj flasdj l dslkjf flk lk;asdj flja dlkasdj f asd faskld flaskf asdkljf sdklj fasdklj fasdklj fskldjf sdklfj 
 adflk asdfklasj fasdklj fsdklfj sdljsdklaj asdlkj aejfa;hga jfslj asdf asdf lsdfjk asdjf askldjf lsadjfk ljfklsadj flaskj fasdklkhf;asldhf asdjhjkasdhflksdh
  asdf;asljflasdjf iowjgakljgasdk;lj asdklj fasdlj fasdlfklasj fasdklj lsdkf asdklj asdljf asdkljf as fsdkl fasdklf ;lasj fj;lasdjfkl fkljas kflasd jfklasf ldhg
   klasdfj asdklj fasd fjasdklj fasdj fasdlj fawe;j fk;lsej flsdkf asdkljf asflkasd askl fi;ojasdl sk;lj f;lasdjfj;s dklasdj klasdj fasdklfj sdkl;jf ;sfd sdfkl 
    asklj fasdklj flkasdj fasdklfj asklj faskljf sjfasklj fklasdasdkl fsdjf asdklj klsadjf jf klasdjf lkasj leslwehioheio ise ieo sd;l aseio isi oieo iooi 
    lks dfjasklj fasdklj fasdklj fasdk;lfj asdklj fasdklfj sdklfj asdklfj asdkljf asdklj fasldkj fasdkl jfweiojfosjf klasj fklasdjf klasdj fklasdjf sdklf';

    
}

//include 'comments.php';
?>

</body>
</html>