<?php

session_start();
include_once('../includes/connection.php');
if (isset($_SESSION['logged_in'])){
    //display index
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
    <!-- ICONOS -->
    <link rel="stylesheet" href="../assets/icomoon/style.css">
    <script src="../assets/js/jquery-3.3.1.js"></script>

    <style>
    a:hover{
        text-decoration: none;
    }
    </style>

    <script>

    $(document).ready(function(){
        $('#checkboxall').click(function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });

        $('#delete').click(function(){
            var dataArr = new Array();
            if($('input:checkbox:checked').length > 0){
                $('input:checkbox:checked').each(function(){
                    dataArr.push($(this).attr('id'));
                    $(this).closest('tr').remove();
                });



            }else{
                alert('Sin seleccinar');
            }
        });


        function sendResponse(dataArr){
            $.ajax({
                type: 'post',
                url: 'delete.php',
                data: {'data' : dataArr},
                success: function(response){
                    alert(response);
                },
                error: function(errResponse){
                    alert(errResponse);
                }
            });
        }


    });
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

<body style="background-color: #f4f4f4;">

<div class="container">
<div class="row centrar">
<h1>ADMINISTRADOR DE BIBLIOTECA</h1>
</div>
</div>

<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
<div class="row">

    <a href="add.php" class="four columns centrar opcionesIndex" style="height: 65px; background-color: #72B2FF; border-radius: 15px; box-shadow: #8e8e8e 0px 0px 9px 1px;">
        <p class="icon-plus" style="color: #fff; font-size: 48px; margin-bottom: 0;"></p>
    </a>
    <a href="usuarios.php" class="four columns centrar opcionesIndex" style="height: 65px; background-color: #f7d151; border-radius: 15px; box-shadow: #8e8e8e 0px 0px 9px 1px;">
        <p class="icon-user" style="color: #fff; font-size: 32px; margin-bottom: 0;"></p>
    </a>
    <a href="logout.php" class="four columns centrar opcionesIndex" style="height: 65px; background-color: #ff5e5e; border-radius: 15px; box-shadow: #8e8e8e 0px 0px 9px 1px;">
        <p class="icon-log-out" style="color: #fff; font-size: 32px; margin-bottom: 0;"></p>
    </a>
    <a href="prestamos.php" class="twelve columns centrar opcionesIndex" style="margin-top: 30px;height: 65px; background-color: #53e499; border-radius: 15px; box-shadow: #8e8e8e 0px 0px 9px 1px;">
        <p class="icon-shopping-cart" style="color: #fff; font-size: 32px; margin-bottom: 0;"></p>
    </a>
</div>
</div>

<div class="container" style="display: none;">
<div class="row">

<input type="text" name="" id="" class="eight columns" placeholder="Buscar...">
<button class="four columns">Buscar</button>

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
<form action="funciones.php" method="post">
    <table class="u-full-width" id="tabla">
        <thead>
            <tr>
                <th>Libro</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Cantidad</th>
                <th>Categoria</th>
                <th>Editar</th>
                <th><input type="submit" value="Eliminar" class="twelve columns eliminar"></th>
                <th><input type="checkbox" name="" id="checkboxall"></th>
            </tr>
        </thead>
        <tbody>

<?php 

foreach($query as $libro){

 ?>

            <tr class="<?php echo $libro["libro_categoria"]; ?>">
                <td><?php echo $libro["libro_titulo"]; ?></td>
                <td><?php echo $libro["libro_autor"]; ?></td>
                <td><?php echo $libro["libro_editorial"]; ?></td>
                <td><?php echo $libro["libro_cantidad"]; ?></td>
                <td><?php echo $libro["libro_categoria"]; ?></td>
                <td><span class="centrar"><a href="editar.php?id=<?php echo $libro['libro_id']; ?>" class="icon-pencil"></a></span></td>
                <td><input type="checkbox" name="selector[]" value="<?php echo $libro["libro_id"]; ?>" class="twelve columns checkbox"></td>
            </tr>
<?php } ?>
        </tbody>
    </table>

</form>

</div>
</div>

<!--<a href="index.php" id="logo" style="color: #000;">CMS</a>-->

<!--<a href="../index.php" style="color: #000;">&larr; Back</a>-->

</body>
</html>


<?php
}else{
    //display login
    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = md5( $_POST['password']);
        if(empty($username) or empty($password)){
            $error = 'All fields are required!';
        } else{
            $query = $pdo->prepare("SELECT * FROM administrador WHERE admin_name = ? AND admin_password = ?");

            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();

            if($num == 1){
                //user entered correct details
                $_SESSION['logged_in'] = true;
                header('Location: index.php');
                exit();
            } else{
                //user entered false details
                $error = 'Incorrect details!';
            }
        }
    }

    //echo md5('admin');
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
<body style="background-color: #f4f4f4; padding: 15px;">

        <a href="#" id="logo" style="color: #000;">ADMIN</a>


<div class="container">
    <div class="row" style="height: 500px; display: flex; justify-content: center; align-items: center;">
        <?php if(isset($error)){?>
            <small style="color: red;"><?php echo $error;?></small>
            
        <?php } ?>

            <span class="centrar" style="">

                <form class="twelve columns" action="index.php" method="post" autocomplete="">
                    <span class="twelve columns centrar">
                        <h1>Login</h1>
                    </span>
                    <span class="twelve columns centrar">
                        <input class="six columns" type="text" name="username" placeholder="Username"/>
                    </span>
                    <span class="twelve columns centrar">
                        <input class="six columns" type="password" name="password" placeholder="Password"/>
                    </span>
                    <span class="twelve columns centrar">
                    <input type="submit" value="Login"/>
                    </span>
                </form>
            </span>
    </div>
</div>

<div class="container">
<div class="row">
<a href="../index.php" style="color: #000;">Salir</a>
</div>
</div>



</body>

<script>
</script>

</html>

    <?php
}
?>