<?php

session_start();
include_once('../includes/connection.php');

$edittable=$_POST['selector'];
$N = count($edittable);
for($i=0; $i < $N; $i++)
{
	$result = $pdo->prepare("DELETE FROM articles WHERE article_id= :memid");
	$result->bindParam(':memid', $edittable[$i]);
	$result->execute();
}
header("location: index.php");
mysql_close($con);


if (isset($_SESSION['logged_in'])){
    //display index
}
?>


<?php


/*
include_once('../includes/connection.php');

if(isset($_POST['data'])){
    $dataArr = $_POST['data'];
    foreach($dataArr as $id){
        mysqli_query($pdo, "DELETE FROM articles WHERE article_id='$id'");
    }
    echo 'Eliminacion satisfactoria';
}
}*/
    ?>


<?php
/*

session_start();
include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article;

if(isset($_SESSION['logged_in'])){
    //display delete page
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
        $query->bindValue(1, $id);
        $query->execute();
        header('Locatoion: delete.php');
    }
    $articles = $article->fetch_all();
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS</title>
    <!--  HOJAS DE ESTILO EN CASCADA  -->
    <link rel="stylesheet" href="../assets/normalize.css">
    <link rel="stylesheet" href="../assets/skeleton.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body style="background-color: #323232; display: flex; justify-content: center; align-items: center;">

<div class="container">
    <div class="row" style="background-color: rgba(255,255,255,0.9); padding: 15px; height: ; border-radius: 25px;">
        <a href="index.php" id="logo" style="color: #000;">CMS</a>
        <br><br>
        <h4>Delete Article</h4>
        <form action="delete.php" method="get" autocomplete="off">



            <select class="twelve columns" name="id" id="" onchange="this.form.submit();">
                <option value="0">Select a Article</option>
                <?php foreach($articles as $article){ ?>
                    <option value="<?php echo $article['article_id']; ?>">
                        <?php echo $article['article_title']; ?>
                    </option>
                <?php } ?>
            </select>
        </form>
        <a href="index.php" style="color: #000;">&larr; Back</a>
    </div>
</div>

</body>
</html>


<?php
} else{
    header('Location: index.php');
}
*/
?>