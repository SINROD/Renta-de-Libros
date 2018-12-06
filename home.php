<?php

session_start();
include_once('includes/connection.php');



if (isset($_SESSION['logged_in'])){
    //display index
    
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BIBLIOTECA</title>
    <!--  HOJAS DE ESTILO EN CASCADA  -->
    <link rel="stylesheet" href="assets/normalize.css">
    <link rel="stylesheet" href="assets/skeleton.css">
    <link rel="stylesheet" href="assets/style.css">
    <!-- ICONOS -->
    <link rel="stylesheet" href="assets/icomoon/style.css">
    <script src="assets/js/jquery-3.3.1.js"></script>

    <style>
    a:hover{
        text-decoration: none;
    }
    </style>

    <script>
    //FILTRADO CON SELECT

$(function(){
	var $tabla = $('#tabla');
	
	$('#filtroCategoria').change(function(){
		var value = $(this).val();
		if (value){
			$('tbody tr.' + value, $tabla).show();
			$('tbody tr:not(.' + value + ')', $tabla).hide();
		}
		else{
			// Se ha seleccionado All
			$('tbody tr', $tabla).show();
		}
	});
});

$(function(){
	var $tabla = $('#tabla');
	
	$('#filtroCarrera').change(function(){
		var value = $(this).val();
		if (value){
			$('tbody tr.' + value, $tabla).show();
			$('tbody tr:not(.' + value + ')', $tabla).hide();
		}
		else{
			// Se ha seleccionado All
			$('tbody tr', $tabla).show();
		}
	});
});


    </script>

</head>

<body>

<div class="" style="width: 100%; background-color: #fff;">
    <div class="container">
        <div class="row">
            <span class="twelve columns" style="height: auto; margin-top: 15px;">
                <span class="twelve columns centrar">
                    <h2 style="color: #888; font-family: k2dregular;">BIBLIOTECA</h2>
                </span>
            </span>
        </div>
    </div>
<div class="container" style="margin-top: 0px; margin-bottom: 50px;">
<div class="row" style="display: flex; justify-content: center; align-items: center;">
        <!--<a href="prestamos.php" class="six columns centrar opcionesIndex" style="height: 65px; background-color: #f7d151; border-radius: 15px; box-shadow: #8e8e8e 0px 0px 9px 1px;">
        <p class="icon-user" style="color: #fff; font-size: 32px; margin-bottom: 0;"></p>
    </a>
<a href="configuracion.php" class="six columns centrar opcionesIndex" style="height: 65px; background-color: #b1b1b1;">
        <p class="icon-cog" style="color: #fff; font-size: 32px; margin-bottom: 0;"></p>
    </a>-->
</div>
</div>

<div class="container">
<div class="row">

<p class="one columns" style="font-size: 18px;">Filtrar:</p>
<p class="one columns">Carrera:</p>
<select name="" id="filtroCarrera" class="two columns">
    <option value="" >Todos</option>
    <option value="Administración">Administración</option>
    <option value="TIC">TIC</option>
    <option value="Industrial">Industrial</option>
    <option value="Electronica">Electronica</option>
    <option value="Mecatronica">Mecatronica</option>
    <option value="Electromecanica">Electromecanica</option>
    <option value="Civil">Civil</option>
    <option value="Arquitectura">Arquitectura</option>
</select>
</div>
</div>


<div class="container">
<div class="row">
<?php 


$query = $pdo->query("SELECT * FROM libro ORDER BY libro_id DESC");


?>        
<form action="funciones.php" method="POST">
    <span class="twelve columns">
        <p class="five columns" style="color: #888;">Favor de colocar tu ID para cada vez que quieras realizar un prestamo. Si no sabes cual es, solocitalo con el administrador.</p>
        <input type="number" name="idUsuario" id="" class="two columns">
    </span>
    <table class="u-full-width" id="tabla">
        <thead>
            <tr>
                <th>Libro</th>
                <th>Autor</th>
                <th>Cantidad</th>
                <th>Carrera</th>
                <th><input type="submit" name="prestamo" value="Prestamo"></th>
            </tr>
        </thead>
        <tbody>

<?php 

foreach($query as $article){

 ?>

            <tr class="<?php echo $article["libro_categoria"]; ?>">
                <td style="display: none;"><input type="text" name="cantidadActual" value="<?php echo $article["libro_cantidad"]; ?>" id=""></td>
                <td><?php echo $article["libro_titulo"]; ?></td>
                <td><?php echo $article["libro_autor"]; ?></td>
                <td><?php echo $article["libro_cantidad"]; ?></td>
                <td><?php echo $article["libro_categoria"]; ?></td>
                <td><input type="checkbox" name="id[]" value="<?php echo $article["libro_id"]; ?>" class="four columns"></td>
            </tr>
<?php } ?>
        </tbody>
    </table>

</form>

</div>

</div>

<div class="container">
<div class="row">
<a href="logout.php" class="icon-log-out one columns" style="font-size: 18px; color: red;">Salir</a>
</div>
</div>

  
</body>
</html>
<?php } ?>