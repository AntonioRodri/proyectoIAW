<?php
    require_once 'Modelo/Alumno.class.php';
    require_once 'Recursos/funcionesSubidaArchivos.php';
    $error = "";
    $alumnoNuevo = new Alumno();
    
    if (filter_input(INPUT_POST, 'alta') !== NULL) {
        require_once  'DAO/AppConfig.php';
        $daoManager = AppConfig::getInstance()->getDAOManager();
        $alumnoDAO = $daoManager->getAlumnoDAO();
        
        //Obtengo las variables del formulario sin acceder al array global.
        $numExp = filter_input(INPUT_POST, 'numexp');
        $dni = filter_input(INPUT_POST, 'dni');
        $nombre = filter_input(INPUT_POST, 'nombre');
        $telefono = filter_input(INPUT_POST, 'tele');
        $foto = comprobarFoto($_FILES['foto']);
        
        //Compruebo si el numero de expediente ya existe.
        if ($alumnoDAO->comprobarAlumno($numExp)) {
            $error = "Ese Número de Expediente ya existe.";
        }else{
            try{
                /*Le voy añadiendo nuevos atributos al nuevo usuario, si alguno es 
                incorrecto, saltará una excepción la cual capturo y muestro su mensaje
                que será la del campo que no es valido.*/
                $alumnoNuevo->setNumExp($numExp);
                $alumnoNuevo->setDni($dni);
                $alumnoNuevo->setNombre($nombre);
                $alumnoNuevo->setTelefono($telefono);
                $alumnoNuevo->setFoto($foto);

                //Por último creo el usuario.
                $alumnoDAO->crear($alumnoNuevo);
                $error = "Alumno creado correctamente.";
                //Y por último cierro la conexión utilizada.
                $alumnoDAO->cerrarConexion();
                //Pongo las variables sin información.
                $numExp = '';
                $dni = '';
                $nombre = '';
                $telefono = '';
                $foto = '';
            } catch (Exception $ex) {
                $error = $ex->getMessage();
            }//END try/catch
        }//END if/else
    }

    ?>
<?php
include 'Vistas/header.php';
?>

<div class="main-container">
    <div><h1>Crear Alumno</h1></div>
    <div class="container">
        <div>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="">Numero Expediente</label><br>
                <input type="text" name="numexp" value='<?php echo (isset($numExp)) ? $numExp : ""; ?>'><br>
                <label for="">DNI</label><br>
                <input type="text" name="dni" value='<?php echo (isset($dni)) ? $dni : ""; ?>'><br>
                <label for="">Nombre</label><br>
                <input type="text" name="nombre" value='<?php echo (isset($nombre)) ? $nombre : ""; ?>'><br>
                <label for="">Telefono</label><br>
                <input type="text" name="tele" value='<?php echo (isset($telefono)) ? $telefono : ""; ?>'><br>
                <label for="">Foto</label><br>
                <input type="file" name="foto"><br>
                <input type="submit" value="Dar de alta" name="alta">
            </form>
        </div>
        <div class="error">
            <h2><?php echo $error?></h2>
        </div>
    </div>
</div>

<?php
include 'Vistas/footer.php';
