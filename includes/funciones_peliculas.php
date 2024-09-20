<?php
function obtener_peliculas(){
require 'database.php';
$sql ="SELECT * FROM pelicula;";
 $resultado = mysqli_query($conexion,$sql);
 return $resultado;
//  $datos = mysql_fetch_assoc($resultado);
//  echo '<pre>';
//  var_dump($resultado);
//  echo '</pre>';
  

}
function obtener_pelicula_por_id($id){
    require 'database.php';
    $sql = 'SELECT * FROM pelicula WHERE id=$id;';
    $resultado = mysqli_query($conexion,$sql);
    return $resultado;

}
function crear_pelicula($titulo,$precio,$director){
require"database.php";

    $sql = "INSERT INTO pelicula(titulo,precio,id_director) VALUES ('$titulo',$precio,$director)" ;
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;
}
function modificar_pelicula($id, $titulo,$precio,$director){
    require "database.php";
    $sql = "UPDATE pelicula SET titulo = '$titulo,precio = $precio, id_director =$director WHERE id = $id;" ;
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;

}
function eliminar_pelicula($id){
    require"database.php";
    $sql = "DELETE FROM PELICULA WHERE id=$id;";
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;
}