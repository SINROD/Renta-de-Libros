<?php
session_start();
include_once('../includes/connection.php');
?>

<!DOCTYPE html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
    <!--  HOJAS DE ESTILO EN CASCADA  -->
    <link rel="stylesheet" href="../assets/normalize.css">
    <link rel="stylesheet" href="../assets/skeleton.css">
    <link rel="stylesheet" href="../assets/style.css">

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

</script>

</head>
<body style="background-color: #f4f4f4; padding-bottom: 50px;">


<div class="container" style="margin-top: 50px;">
<div class="row">

<h2>USUARIOS</h2>

<?php 


$query = $pdo->query("SELECT * FROM usuario ORDER BY usuario_id DESC");


?>        
<form action="funciones.php" method="post">
    <table class="u-full-width">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th><input type="submit" value="Eliminar" class="twelve columns eliminar"></th>
                <th><input type="checkbox" name="" id="checkboxall"></th>
            </tr>
        </thead>
        <tbody>

<?php 

foreach($query as $usuario){

 ?>

            <tr>
                <td><?php echo $usuario["usuario_id"]; ?></td>
                <td><?php echo $usuario["usuario_nombre"]; ?></td>
                <td><?php echo $usuario["usuario_direccion"]; ?></td>
                <td><?php echo $usuario["usuario_telefono"]; ?></td>
                <td><input type="checkbox" name="eliminarUsuario[]" value="<?php echo $usuario["usuario_id"]; ?>" class="twelve columns checkbox"></td>
            </tr>
<?php } ?>
        </tbody>
    </table>

</form>



</div>
<a href="index.php" style="color: #000; font-size: 20px;">&larr; REGRESAR</a>
</div>






</body>
</html>