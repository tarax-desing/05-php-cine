<?php
function obtener_directores(){
require 'database.php';
$sql ="SELECT * FROM director;";
 $resultado = mysqli_query($conexion,$sql);
 return $resultado;
}