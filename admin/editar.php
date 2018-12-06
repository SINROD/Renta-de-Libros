<?php
session_start();
include_once('../includes/connection.php');

$id = $_GET["id"];

$con = "SELECT * FROM libro WHERE libro_id = $id";
$query = $pdo->query($con);
$query->execute();

$data = $query->fetch();

?>

<!DOCTYPE html lang="es">
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
<form action="funciones.php" method="post">
<input type="hidden" style="display: none;" name="id" value="<?php echo $data["libro_id"]; ?>">
<span class="twelve columns" style="">
            <p class="two columns">Titulo del libro:</p>
            <input type="text" name="titulo" id="" class="ten columns" value="<?php echo $data["libro_titulo"]; ?>">
        </span>
        <span class="six columns" style="margin-left:0;">
            <p class="six columns">Autor:</p>
            <input type="text" name="autor" id="" class="six columns" value="<?php echo $data["libro_autor"]; ?>">
        </span>
        <span class="six columns">
            <p class="six columns">ISBN del libro:</p>
            <input type="text" name="ISBN" id="" class="six columns" value="<?php echo $data["libro_ISBN"]; ?>">
        </span>
        <span class="six columns" style="margin-left:0;">
            <p class="six columns">Editorial del libro:</p>
            <input type="text" name="editorial" id="" class="six columns" value="<?php echo $data["libro_editorial"]; ?>">
        </span>
        <span class="six columns">
            <p class="six columns">Paginas del libro:</p>
            <input type="text" name="paginas" id="" class="six columns" value="<?php echo $data["libro_paginas"]; ?>">
        </span>

        <span class="six columns" style="margin-left:0;">
            <p class="six columns">Categoria del libro:</p>
            <select name="categoria" id="" class="six columns">
                <option value="<?php echo $data["libro_categoria"]; ?>" hidden><?php echo $data["libro_categoria"]; ?></option>
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
            <input type="number" name="cantidad" id="" class="six columns" value="<?php echo $data["libro_cantidad"]; ?>">
        </span>

<input type="submit" value="Modificar" name="modificar" class="twelve columns">

</form>

</div>
<a href="index.php" style="color: #000; font-size: 20px;">&larr; REGRESAR</a>
</div>






</body>
</html>