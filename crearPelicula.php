<?php
session_start();
//comprobar de donde viene la llamadaç



require 'includes/funciones_directores.php';
require 'includes/funciones_peliculas.php';
$lista_directores = obtener_directores();

$pelicula = '';
if (isset($_SESSION['metodo']) && $_SESSION['metodo'] === 'modificar') {
    $id = $_SESSION['idPelicula'];
    $respuesta = obtener_pelicula_por_id($id);
    $pelicula = mysqli_fetch_assoc($respuesta);
    //destruyo las variables
    unset($_SESSION['metodo']);
    unset($_SESSION['idPelicula']);
    var_dump($pelicula);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="container">
        <h1>Registrar nueva película</h1>
        <?php echo ($pelicula != ' ') ? '<h1>Modificar Película</h1>' : '<h1>Registrar nueva película</h1>' ?>

        <form class='formulario-creacion' action="includes/control_peliculas.php" method="post">

            <input type="hidden" name="metodo" value="crear">
            <input type="hidden" name="metodo" value="<?php echo ($pelicula != '') ? 'modificacion' : 'crear' ?>">
            <input type="hidden" name="id" value="<?php echo ($pelicula != '') ? $pelicula['id'] : '' ?>">
            <div class="campo-form">
            <label for="titulo">Título:</label>
               
                <input type="text" name="titulo" required value="<?php echo ($pelicula != '') ? $pelicula['titulo'] : '' ?>">
            </div>
            <div class="campo-form">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" required  value="<?php echo ($pelicula != '') ? $pelicula['precio'] : '' ?>">
            </div>
            <div class="box campo-form">
                <label for="directores">Director</label>
                <select name="directores">
                    <?php
                    $currentDirector = ($pelicula != '') ? $pelicula['id_director'] : '';
                    while ($director = mysqli_fetch_assoc($lista_directores)) {
                        $selected = ($currentDirector == $director['id']) ? 'selected' : '';
                        echo "<option value='$director[id]'$selected>$director[nombre] $director[apellido]</option>";
                         $selected = ($currentDirector == $director['id']) ? 'selected' : '';
                        echo "<option 
                            value='$director[id]'
                            $selected
                            >
                            $director[nombre] $director[apellido]
                            </option>";
                    }

                    ?>

                </select>


            </div>
            <div class="sub-formulario">
                <a class="nuevoRegistro" href="admin.php">Volver</a>
                <input class="nuevoRegistro" type="submit" value="Enviar datos">
            </div>
        </form>
        <?php
        if (isset($_SESSION["mensaje"])) {
            echo "<p>" . $_SESSION["mensaje"] . "</p>";
            unset($_SESSION["mensaje"]);
        }
        if (isset($_SESSION["datos_insertados"])) {
            echo "<h2>" . $_SESSION['accion'] . "</h2>";
            echo "<ul>";
            foreach ($_SESSION["datos_insertados"] as $campo => $valor) {
                echo "<li>" . ucfirst($campo) . ":" . htmlspecialchars($valor) . "</li>";
            }
            echo "</ul>";
            unset($_SESSION["datos_insertados"]);
            unset($_SESSION['accion']);


        }

        ?>
    </div>
</body>

</html>