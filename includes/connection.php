<?php

try{
$pdo = new PDO('mysql:host=localhost;dbname=miriam', 'root', '');
} catch (PDOException $e){
    exit('Database error.');
}
?>