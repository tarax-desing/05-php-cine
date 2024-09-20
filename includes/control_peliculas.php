<?php
session_start();
require 'funciones_peliculas.php';
$metodo = '';

if (isset($_POST) && isset($_POST['metodo'])) {
    $metodo = $_POST['metodo'];
}

if ($metodo === 'crear') {

    $titulo = $_POST['titulo'];

    $precio = (int) $_POST['precio'];

    $director = $_POST['directores'];

    $respuesta = crear_Pelicula($titulo, $precio, $director);
    if ($respuesta) {
        $_SESSION['mensaje'] = "los datos se insertaron correctamente";
        $_SESSION['accion'] = "Última película creada";
        $_SESSION['datos_insertados'] = [
            'titulo' => $titulo,
            'precio' => $precio,
            'director' => $director,
        ];

    } else {

        $_SESSION['mensaje'] = 'Error' . mysqli_connect_error();

    }
    header("Location: ../crearPelicula.php");
    exit();
}

if (isset($_POST['metodo']) && $_POST['metodo'] === 'delete') {
    $id = $_POST['id'];
    $respuesta = eliminar_pelicula($id);
    if ($respuesta) {
        echo json_encode(['success' => true, 'message' => 'Película eliminada']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    }
}
var_dump($_POST);
if ($metodo === 'modificar') {
    $_SESSION['idPelicula'] = $_POST['idPelicula'];
    $_SESSION['metodo'] = $_POST['modificar'];
    header("Location: ../crearPelicula.php");
    exit();
}
if($metodo === 'modificacion'){

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $director = $_POST['directores'];

    $respuesta = modificar_pelicula($id, $titulo, $precio, $director);

    if ($respuesta) {
        $_SESSION['mensaje'] = "Los datos se modificaron correctamente.";
        $_SESSION['accion'] = "Película modificada";
        $_SESSION['datos_insertados'] = [
            'titulo' => $titulo,
            'precio' => $precio,
            'director' => $director
        ];
    } else {
        $_SESSION['mensaje'] = "Error: " . mysqli_connect_error();
    }
    header("Location: ../crearPelicula.php");
    exit();
}
