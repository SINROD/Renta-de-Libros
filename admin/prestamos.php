<?php
session_start();
include_once('../includes/connection.php');
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

<h2>PRESTAMOS</h2>

<?php 


$query = $pdo->query("SELECT P.*, L.*, U.* FROM prestamo P INNER JOIN libro L ON prestamo_libro = libro_id INNER JOIN usuario U ON P.prestamo_usuario = U.Usuario_id ORDER BY prestamo_id DESC");


?>        
<form action="funciones.php" method="post">
    <table class="u-full-width">
        <thead>
            <tr>
                <th>Libro</th>
                <th>Autor</th>
                <th>Usuario</th>
                <th>Fecha de devolucion</th>
                <th>Fecha de prestamo</th>
                <th><input type="submit" value="Regresar" class="twelve columns eliminar"></th>
            </tr>
        </thead>
        <tbody>

<?php 

foreach($query as $prestamo){

 ?>

            <tr>
                <td style="display: none;"><input type="text" name="cantidadActual" value="<?php echo $prestamo["libro_cantidad"]; ?>" id=""></td>
                <td style="display: none;"><input type="text" name="libro" value="<?php echo $prestamo["libro_id"]; ?>" id=""></td>
                <td><?php echo $prestamo["libro_titulo"]; ?></td>
                <td><?php echo $prestamo["libro_autor"]; ?></td>
                <td><?php echo $prestamo["usuario_nombre"]; ?></td>
                <td><?php echo $prestamo["prestamo_dia_devolucion"]; ?></td>
                <td><?php echo $prestamo["prestamo_dia_prestamo"]; ?></td>
                <td><input type="checkbox" name="eliminarPrestamo[]" value="<?php echo $prestamo["prestamo_id"]; ?>" class="twelve columns checkbox"></td>
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