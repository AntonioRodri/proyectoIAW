<?php
session_start();
require_once 'Recursos/funcionesComunes.php';

$error = "";

if (filter_input(INPUT_POST, "aceptar") != NULL) {
    
    $login = filter_input(INPUT_POST, "user");
    $pass = sha1(filter_input(INPUT_POST, "pass"));
    
    //Esto mejor incluirlo en el header.php
    require_once  'DAO/AppConfig.php';
    require_once 'Modelo/Usuario.class.php';

    // Obtengo la instancia para acceder el manager de los DAO.
    $daoManager = AppConfig::getInstance()->getDAOManager();
    $usuarioDAO = $daoManager->getUsuarioDAO();
    
    if (empty(trim($login)) || trim(empty($pass))) {
        $error = "Campos vacios";
    }elseif (!$usuarioDAO->comprobarUsuario($login, $pass)) {
        $error = "Usuario o contraseña incorrectos";
    }else{
        // Si todo va bien comienzo la conexión y asigno variables del nombre y redirijo a otra página.
        $usuarioCorrecto = $usuarioDAO->consultar($login);
        iniciarSesion($usuarioCorrecto);
        var_dump($usuarioCorrecto);
        $usuarioDAO->cerrarConexion();
    }//END if/else
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/mycssLogin.css">
</head>
<body>
    <div class="main-container">
        <div class="container">
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <label for="">User</label>
                <input type="text" name="user"><br>
                <label for="">Password</label>
                <input type="text" name="pass"><br>
                <!--<label for="recuerda">Recuérdame</label>-->
                <!--<input type="checkbox" name="recuerda" id="recuerda"><br>-->
                <div>
                    <a href="registrarUsuario.php">Registrarse</a>
                </div>
                <input type="submit" value="Aceptar" name="aceptar">
            </form>
            <div class="error">
                <h2><?php echo $error?></h2>
            </div>
        </div>
    </div>
</body>
</html>