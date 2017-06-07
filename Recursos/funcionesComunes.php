<?php

/**
 * Inicia la Session y crea una variable con el usuario que se le pasa por parametro.
 * @param type $usuario
 */
function iniciarSesion(Usuario $usuario) {
    //session_start();
    $_SESSION['userLogin'] = serialize($usuario);
    header("Location:index.php");
}

/**
 * 
 * @return boolean
 */
function comprobarSesionActual() {
//    session_start();
    if (isset($_SESSION['userLogin'])) {
        return true;
    }
    return false;
}

/**
 * Cierra la Session y elimina las cokkies que recuerdan la session.
 */
function cerrarSesion() {
    session_destroy();
    unset($_SESSION);
//    borrarCookie("user");
//    borrarCookie("pass");
    header("Location:login.php");
}