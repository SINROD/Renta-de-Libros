<?php

session_start();
include_once('../includes/connection.php');

if (isset($_POST["selector"])) {
	$edittable=$_POST['selector'];
	$N = count($edittable);
	for($i=0; $i < $N; $i++)
	{
		$result = $pdo->prepare("DELETE FROM libro WHERE libro_id= :memid");
		$result->bindParam(':memid', $edittable[$i]);
		$result->execute();
	}
	header("location: index.php");
	mysql_close($con);
	
}
elseif (isset($_POST["eliminarUsuario"])) {
	$eliminarUsuario=$_POST['eliminarUsuario'];
	$N = count($eliminarUsuario);
	for($i=0; $i < $N; $i++)
	{
		$result = $pdo->prepare("DELETE FROM usuario WHERE usuario_id= :memid");
		$result->bindParam(':memid', $eliminarUsuario[$i]);
		$result->execute();
	}
	header("location: usuarios.php");
	mysql_close($con);
	
}

elseif(isset($_POST["eliminarPrestamo"])){
	$eliminarPrestamo=$_POST['eliminarPrestamo'];
	$N = count($eliminarPrestamo);
	for($i=0; $i < $N; $i++)
	{
		$result = $pdo->prepare("DELETE FROM prestamo WHERE prestamo_id= :memid");
		$result->bindParam(':memid', $eliminarPrestamo[$i]);
		$result->execute();
		if(true){
			$cantidadActual = $_POST["cantidadActual"];
			$libro = $_POST["libro"];
			$cantidad = $cantidadActual + 1;
			$statement = $pdo->prepare("UPDATE libro SET libro_cantidad = :cantidad WHERE libro_id = :libro");
			$statement->bindParam(":cantidad", $cantidad);
			$statement->bindParam(":libro", $libro);
			$statement->execute();
		}
	}
	header("location: prestamos.php");
	mysql_close($con);

}

elseif(isset($_POST["modificar"])){
	$nombreautor = $_POST['autor'];
	$librotitulo = $_POST['titulo'];
	$libroISBN = $_POST['ISBN'];
	$libroeditorial = $_POST['editorial'];
	$libropaginas = $_POST['paginas'];
	$categoria = $_POST['categoria'];
	$cantidad = $_POST['cantidad'];
	$id = $_POST["id"];
	
    $con = "UPDATE libro 
                SET libro_titulo = :titulo,
                    libro_ISBN = :ISBN,
                    libro_editorial = :editorial,
                    libro_paginas = :paginas ,
                    libro_autor = :autor,
                    libro_cantidad = :cantidad,
                    libro_categoria = :categoria
            WHERE libro_id = :id";
    $statement = $pdo->prepare($con);
    $statement->bindParam(":titulo", $librotitulo);
    $statement->bindParam(":ISBN", $libroISBN);
    $statement->bindParam(":editorial", $libroeditorial);
    $statement->bindParam(":paginas", $libropaginas);
    $statement->bindParam(":autor", $nombreautor);
    $statement->bindParam(":cantidad", $cantidad);
    $statement->bindParam(":categoria", $categoria);
    $statement->bindParam(":id", $id);

    $statement->execute();

    header('Location: index.php');

}



?>