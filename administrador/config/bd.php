<?php
$host="localhost"; 
$bd="bd";
$usuario="root";
$conrasenia="1234";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd", $usuario,$conrasenia);
    if ($conexion) {
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>