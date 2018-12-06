<?php
session_start();
include_once('../includes/connection.php');
if(isset($_SESSION['logged_in'])){
    //display add page

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
<body style="background-color: #f4f4f4; padding-bottom: 50px;">

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <?php if(isset($error)){?>
            <small style="color: red;"><?php echo $error;?></small>
            <br><br>
        <?php } ?>

        <span class="twelve columns centrar" style="background-color: #d4d4d4; color: #fff; margin-bottom: 2rem; padding: 10px 0;">
            <h2 style="margin: 0;">Articulo</h2>
        </span>

        <form action="add.php" method="post" autocomplete="off">

<?php     if(isset($_POST['autor'])){
  
  $nombreautor = $_POST['autor'];
  $librotitulo = $_POST['titulo'];
  $libroISBN = $_POST['ISBN'];
  $libroeditorial = $_POST['editorial'];
  $libropaginas = $_POST['paginas'];
  $categoria = $_POST['categoria'];
  $cantidad = $_POST['cantidad'];


  if(empty($nombreautor)){
      $error = 'All fields are required!';
  } else{
      $query = $pdo->prepare('INSERT INTO libro (libro_titulo, libro_ISBN, libro_editorial, libro_paginas, libro_autor, libro_cantidad, libro_categoria) VALUES (?, ?, ?, ?, ?, ?, ?)');
      
      $query->bindValue(1, $librotitulo);
      $query->bindValue(2, $libroISBN);
      $query->bindValue(3, $libroeditorial);
      $query->bindValue(4, $libropaginas);
      $query->bindValue(5, $nombreautor);
      $query->bindValue(6, $cantidad);
      $query->bindValue(7, $categoria);

      $query->execute();
      header("Location:index.php");
  }
}
?>

        <span class="twelve columns" style="">
            <p class="two columns">Titulo del libro:</p>
            <input type="text" name="titulo" id="" class="ten columns">
        </span>
        <span class="six columns" style="margin-left:0;">
            <p class="six columns">Autor:</p>
            <input type="text" name="autor" id="" class="six columns">
        </span>
        <span class="six columns">
            <p class="six columns">ISBN del libro:</p>
            <input type="text" name="ISBN" id="" class="six columns">
        </span>
        <span class="six columns" style="margin-left:0;">
            <p class="six columns">Editorial del libro:</p>
            <input type="text" name="editorial" id="" class="six columns">
        </span>
        <span class="six columns">
            <p class="six columns">Paginas del libro:</p>
            <input type="text" name="paginas" id="" class="six columns">
        </span>

        <span class="six columns" style="margin-left:0;">
            <p class="six columns">Categoria del libro:</p>
            <select name="categoria" id="" class="six columns">
                <option value=""disabled selected hidden>Selecciona una categoria</option>
                <option value="Administración">Administración</option>
                <option value="TIC">TIC</option>
                <option value="Industrial">Industrial</option>
                <option value="Electronica">Electronica</option>
                <option value="Mecatronica">Mecatronica</option>
                <option value="Electromecanica">Electromecanica</option>
                <option value="Civil">Civil</option>
                <option value="Arquitectura">Arquitectura</option>
            </select>
        </span>
        <span class="six columns">
            <p class="six columns">Cantidad del libro:</p>
            <input type="number" name="cantidad" id="" class="six columns">
        </span>

<input type="submit" value="Guardar" class="twelve columns">

        </form>


    </div>
</div>




</div>

<div class="container">
<div class="row">
<a href="index.php" style="color: #000; font-size: 20px;">&larr; REGRESAR</a>
</div>
</div>

</div>


</body>
</html>

<?php
} else {
    header('Location: index.php');
}
?>