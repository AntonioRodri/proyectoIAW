<?php
session_start();
require_once 'Recursos/funcionesComunes.php';

// Compruebo si la sessión existe, y si no lo mando al login.php
if (!comprobarSesionActual()) {
    header("Location:login.php");
}//END if/else

if (filter_input(INPUT_GET, "salir") != NULL) {
    cerrarSesion();
}