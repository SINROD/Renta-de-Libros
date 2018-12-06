<?php

include_once('includes/connection.php');

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTRAR</title>
    <!--  HOJAS DE ESTILO EN CASCADA  -->
    <link rel="stylesheet" href="assets/normalize.css">
    <link rel="stylesheet" href="assets/skeleton.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background-color: #f4f4f4; padding: 15px;">

        <a href="#" id="logo" style="color: #000;">BIBLIOTECA</a>


<div class="container">
    <div class="row" style="height: 500px; display: flex; justify-content: center; align-items: center;">
        <?php if(isset($error)){?>
            <small style="color: red;"><?php echo $error;?></small>
        <?php } 
        
        if(isset($_POST['usuario'])){
  
            $usuarionombre = $_POST['usuario'];
            $usuariocontrasena = md5( $_POST['password']);
            $usuariodireccion =$_POST['direccion'];
            $usuariotelefono = $_POST['telefono'];
            
    
            if(empty($usuarionombre) or empty($usuariodireccion)){
                $error = 'All fields are required!';
            } else{
                $query = $pdo->prepare('INSERT INTO usuario (usuario_nombre, usuario_password, usuario_direccion, usuario_telefono) VALUES (?, ?, ?, ?)');
                
                $query->bindValue(1, $usuarionombre);
                $query->bindValue(2, $usuariocontrasena);
                $query->bindValue(3, $usuariodireccion);
                $query->bindValue(4, $usuariotelefono);
    
    
                $query->execute();
    
                header('Location: index.php');
            }
        }
        ?>

            <span class="centrar" style="">

                <form class="twelve columns" action="registrar.php" method="post" autocomplete="">
                    <span class="twelve columns centrar">
                        <h1>REGISTRAR</h1>
                    </span>
                    <span class="twelve columns centrar">
                        <input class="six columns" type="text" name="usuario" placeholder="Nombre"/>
                    </span>
                    <span class="twelve columns centrar">
                        <input class="six columns" type="password" name="password" placeholder="Password"/>
                    </span>
                    <span class="twelve columns centrar">
                        <input class="six columns" type="text" name="direccion" placeholder="Direccion"/>
                    </span>
                    <span class="twelve columns centrar">
                        <input class="six columns" type="number" name="telefono" placeholder="Telefono"/>
                    </span>
                    <span class="twelve columns centrar">
                    <input type="submit" value="Guardar"/>
                    </span>
                </form>

            </span>

    </div>
</div>

       


</body>

<script>
</script>

</html>
