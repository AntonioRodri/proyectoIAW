<?php
session_start();
require_once 'Recursos/funcionesComunes.php';

// Compruebo si la sessión existe, y si no lo mando al login.php
if (!comprobarSesionActual()) {
    header("Location:login.php");
}//END if/else


//Importo esto aquí para que al deserializar el objeto encuentre la clase del objeto.
require_once __DIR__.'/../Modelo/Usuario.class.php';
//Si llega aquí es porque la sesión existe y esta el objeto (lo desserializo)
$usuarioCorrecto = unserialize($_SESSION['userLogin']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Prueba </title>
    <!--OJO!! Las rutas son desde el index.php no desde aquí, sino falla-->
    <link href="css/mycss.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<img src=<?php echo '"imagenes/'.$usuarioCorrecto->getFoto().'"'?> alt="">
        <h1><?php echo $usuarioCorrecto->getNombre() . " - " ?><a class="salir" href="logout.php?salir=1">Salir</a></h1>
	</header>
    	<main>
            <aside>
                <div><a href="index.php" class="menu">Página Principal</a></div>
                <div><a href="crearAlumno.php" class="menu">Crear Alumno</a></div>
                <div><a href="borrarAlumno.php" class="menu">Borrar Alumno</a></div>
                <div><a href="actualizarAlumno.php" class="menu">Actualizar Alumno</a></div>
                <div><a href="consultarAlumno.php" class="menu">Consultar Alumno</a></div>
                <div><a href="listarAlumnos.php" class="menu">Lista Alumnos</a></div>
                <div><a href="asignaturas.php" class="menu">Asignaturas</a></div>
                <div><a href="configuracionUsuario.php" class="menu">Configuración</a></div>
            </aside>