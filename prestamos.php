<?php
session_start();
include_once('includes/connection.php');
?>

<!DOCTYPE html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRESTAMOS</title>
    <!--  HOJAS DE ESTILO EN CASCADA  -->
    <link rel="stylesheet" href="assets/normalize.css">
    <link rel="stylesheet" href="assets/skeleton.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background-color: #; padding-bottom: 50px;">


<div class="container" style="margin-top: 50px;">
<div class="row">

<div class="container">
<div class="row">
<?php 


$query = $pdo->query("SELECT P.*, L.* FROM prestamo P INNER JOIN libro L ON P.prestamo_libro = L.libro_id ORDER BY prestamo_id DESC");

?>        
<form action="funciones.php" method="post">
    <table class="u-full-width">
        <thead>
            <tr>
                <th>Libro</th>
                <th>Autor</th>
                <th>Cantidad</th>
                <th>Fecha de prestamo</th>
                <th>Fecha de devolucion</th>
            </tr>
        </thead>
        <tbody>

<?php 

foreach($query as $article){

 ?>

            <tr>
                <td><?php echo $article["libro_titulo"]; ?></td>
                <td><?php echo $article["libro_autor"]; ?></td>
                <td><?php echo $article["libro_cantidad"]; ?></td>
                <td><?php echo $article["prestamo_dia_prestamo"]; ?></td>
                <td><?php echo $article["prestamo_dia_devolucion"]; ?></td>
            </tr>
<?php } ?>
        </tbody>
    </table>

</form>

</div>
</div>



</div>
<a href="home.php" style="color: #000; font-size: 20px;">&larr; REGRESAR</a>
</div>





</body>
</html>