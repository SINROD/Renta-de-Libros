<?php

session_start();
include_once('includes/connection.php');

//fechas
$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '+2 day' , strtotime ( $fecha ) ) ;
$devolucion = date ( 'Y-m-j' , $nuevafecha );//mas 3 dias

$fecha1 = date('Y-m-j');
$fecha2 = strtotime ( '-1 day' , strtotime ( $fecha1 ) ) ;
$prestamo = date ( 'Y-m-j' , $fecha2 );


$libro = $_POST['id'];
$num = count($libro);


for($n=0; $n<$num; $n++){
	$id = $libro[$n];
	
}

$idUsuario = $_POST['idUsuario'];

//if(isset($_POST['prestamo'])){
if(isset($_POST["prestamo"])){
	
	if(empty($idUsuario)){
		echo "<script>
 alert('Favor de colocar tu ID para realizar el prestamo.');
 window.location= 'home.php'
</script>";
	} else{
			$query = $pdo->prepare('INSERT INTO prestamo (prestamo_libro, prestamo_dia_prestamo, prestamo_dia_devolucion, prestamo_usuario) VALUES (?, ?, ?, ?)');

			$query->bindValue(1, $id);
			$query->bindValue(2, $prestamo);
			$query->bindValue(3, $devolucion);
			$query->bindValue(4, $idUsuario);
			$query->execute();
			if(true){
				$cantidadActual = $_POST["cantidadActual"];
				//echo $cantidadActual;
				//$cantidadActual = $cantidadActual - 1;
				//echo $cantidadActual;
				$statement = $pdo->prepare("UPDATE libro SET libro_cantidad = libro_cantidad - 1 WHERE libro_id = :id");
				//$statement->bindParam(":cantidadActual", $cantidadActual);
				$statement->bindParam(":id", $id);
				
				//$cantidadActual = $cantidadActual - 1;
				//echo $cantidadActual;
				
				$statement->execute();
			}
			header('Location: exitoso.php');
		}

}

?>