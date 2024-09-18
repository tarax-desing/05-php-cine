<?php

$conexion = mysqli_connect('localhost','root','','cinebd');
if(mysqli_connect_errno()){
    echo "la  conexión a  la base de datos ha fallado:" . mysqli_connect_error();
    exit();
}
