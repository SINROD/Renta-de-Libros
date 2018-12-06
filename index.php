

<?php
session_start();

include_once('includes/connection.php');

    //display login
    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = md5( $_POST['password']);
        if(empty($username) or empty($password)){
            $error = 'All fields are required!';
        } else{
            $query = $pdo->prepare("SELECT * FROM usuario WHERE usuario_nombre = ? AND usuario_password = ?");

            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();
            print_r($query);
            if($num == 1){
                //user entered correct details
                $_SESSION['logged_in'] = true;
                header('Location: home.php');
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
    <title>BIBLIOTECA</title>
    <!--  HOJAS DE ESTILO EN CASCADA  -->
    <link rel="stylesheet" href="assets/normalize.css">
    <link rel="stylesheet" href="assets/skeleton.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="padding: 15px;">

        <a href="#" id="logo" style="color: #000;">BIBLIOTECA</a>


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
                        <input class="six columns" type="text" name="username" placeholder="username"/>
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
<a href="registrar.php" style="color: #000; font-size: 18px;">Registrar</a>
</div>
</div>



</body>

<script>
</script>

</html>
