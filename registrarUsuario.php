<?php
require_once 'Modelo/Usuario.class.php';
require_once 'Recursos/funcionesSubidaArchivos.php';
$error = "";
$usuarioNuevo = new Usuario();

if (filter_input(INPUT_POST, 'alta') !== NULL) {
    require_once  'DAO/AppConfig.php';
    $daoManager = AppConfig::getInstance()->getDAOManager();
    $usuarioDAO = $daoManager->getUsuarioDAO();

    //Obtengo las variables del formulario sin acceder al array global.
    $login = filter_input(INPUT_POST, 'login');
    $nombre = filter_input(INPUT_POST, 'nombre');
    $pass = filter_input(INPUT_POST, 'pass');
    $email = filter_input(INPUT_POST, 'email');
    $foto = comprobarFoto($_FILES['foto']);

    //Compruebo si el numero de expediente ya existe.
    if ($usuarioDAO->comprobarLoginUsuario($login)) {
        $error = "Ese login ya existe.";
    }elseif ($usuarioDAO->comprobarEmailUsuario($email)) {
        $error = "Ese email ya existe.";
    } else{
        try{
            /*Le voy añadiendo nuevos atributos al nuevo usuario, si alguno es 
            incorrecto, saltará una excepción la cual capturo y muestro su mensaje
            que será la del campo que no es valido.*/
            $usuarioNuevo->setLogin($login);
            $usuarioNuevo->setNombre($nombre);
            $usuarioNuevo->setPass($pass);
            $usuarioNuevo->setEmail($email);
            $usuarioNuevo->setFoto($foto);

            //Por último creo el usuario.
            $usuarioDAO->crear($usuarioNuevo);
            $error = "Usuario creado correctamente.";
            //Y por último cierro la conexión utilizada.
            $usuarioDAO->cerrarConexion();
            //Pongo las variables sin información.
            $login = '';
            $pass = '';
            $nombre = '';
            $email = '';
            $foto = '';
        } catch (Exception $ex) {
            $error = $ex->getMessage();
        }//END try/catch
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
            <h1>Registro de Usuario</h1>
            <div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Login</label><br>
                    <input type="text" name="login" value='<?php echo (isset($login)) ? $login : ""; ?>'><br>
                    <label for="">Nombre</label><br>
                    <input type="text" name="nombre" value='<?php echo (isset($nombre)) ? $nombre : ""; ?>'><br>
                    <label for="">Pass</label><br>
                    <input type="text" name="pass" value='<?php echo (isset($pass)) ? $pass : ""; ?>'><br>
                    <label for="">email</label><br>
                    <input type="text" name="email" value='<?php echo (isset($email)) ? $email : ""; ?>'><br>
                    <label for="">Foto</label><br>
                    <input type="file" name="foto"><br>
                    <input type="submit" value="Dar de alta" name="alta">
                </form>
            </div>
            <div class="error">
                <h2><a href="login.php">Volver</a></h2>
            </div>
            <div class="error">
                <h2><?php echo $error?></h2>
            </div>
        </div>
    </div>
</body>
</html>