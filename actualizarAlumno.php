<?php
include 'Vistas/header.php';
?>
<?php
    require_once  'DAO/AppConfig.php';
    $error = "";
    //Para controlar que se vea el formulario para modificar.
    $verFormulario = false;
    $volverAMostrar = false;
    
    // Si viene algo del formulario de buscar, entonces hago esto.
    if (filter_input(INPUT_POST, "buscar") != NULL) {
        require_once  'DAO/AppConfig.php';
        $daoManager = AppConfig::getInstance()->getDAOManager();
        $alumnosDAO = $daoManager->getAlumnoDAO();
        // Obtengo ek valor del input
        $numExp = filter_input(INPUT_POST, "numexp");
        
        if ($alumnosDAO->comprobarAlumno($numExp)) {
            $alumnoConsultado = $alumnosDAO->consultar($numExp);
            //Si existe el alumno muestro el formulario.
            $verFormulario = true;
            //Por último ciero la conexion utilizada.
            $alumnosDAO->cerrarConexion();
        }else{
            $error = "Ese Alumno no existe, no se puede modificar.";
        }// END if/else
    }//END if
    
    // Si viene algo del formulario de modificar, entonces hago esto.
    if (filter_input(INPUT_POST, "modificar") != NULL) {
        require_once  'DAO/AppConfig.php';
        require_once 'Recursos/funcionesSubidaArchivos.php';
        //Obtengo los DAOs
        $daoManager = AppConfig::getInstance()->getDAOManager();
        $alumnosDAO = $daoManager->getAlumnoDAO();
        
        //Obtengo las variables del formulario sin acceder al array global.
        $numExp = filter_input(INPUT_POST, 'numexp');
        $dni = filter_input(INPUT_POST, 'dni');
        $nombre = filter_input(INPUT_POST, 'nombre');
        $telefono = filter_input(INPUT_POST, 'tele');
        
        
        $alumnoConsultado = $alumnosDAO->consultar($numExp);
        
        // Gestionar la foto, si se sube una nueva foto la subo y le doy el valor al campo.
        // Si no la sube le vuevo a dar la que tenía.
        if ($_FILES['foto']['error'] > 0) {
            $foto = $alumnoConsultado->getFoto();
        }else{
            $foto = subirFichero($_FILES['foto']);
        }
        
        $alumnoModificado = new Alumno();
         try{
            /*Le voy añadiendo nuevos atributos al nuevo alumno, si alguno es 
            incorrecto, saltará una excepción la cual capturo y muestro su mensaje
            que será la del campo que no es valido.*/
            $alumnoModificado->setNumExp($numExp);
            $alumnoModificado->setDni($dni);
            $alumnoModificado->setNombre($nombre);
            $alumnoModificado->setTelefono($telefono);
            $alumnoModificado->setFoto($foto);

            //Por último modifico el usuario.
            $alumnosDAO->actualizar($alumnoModificado);
            $error = "Alumno modificado correctamente.";
            //Y por último cierro la conexión utilizada.
            $alumnosDAO->cerrarConexion();
        } catch (Exception $ex) {
            //Si salta la excepción es que los datos no son correctos y lo vuelvo a mostrar.
            $volverAMostrar = true;
            $error = $ex->getMessage();
        }//END try/catch

    }//END if

?>
<div class="main-container">
    <div><h1>Actualizar Alumno</h1></div>
    <div class="container">
        <div>
            <form action="" method="POST">
                <label for="">Número de Expediente</label><br>
                <input type="text" name="numexp"><br>
                <input type="submit" name="buscar" value="Consultar">
            </form>
        </div>
        <?php
        //Si alguna es true muestro el formulario de modificación.
        if ($verFormulario || $volverAMostrar) {
        ?>
            <div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Numero Expediente: </label><br>
                    <input type="text" name="numexp" readonly="readonly" value='<?php echo ($alumnoConsultado->getNumExp() !== NULL) ? $alumnoConsultado->getNumExp() : ""; ?>'><br>
                    <label for="">DNI</label><br>
                    <input type="text" name="dni" value='<?php echo ($alumnoConsultado->getDni() !== NULL) ? $alumnoConsultado->getDni() : ""; ?>'><br>
                    <label for="">Nombre</label><br>
                    <input type="text" name="nombre" value='<?php echo ($alumnoConsultado->getNombre() !== NULL) ? $alumnoConsultado->getNombre() : ""; ?>'><br>
                    <label for="">Telefono</label><br>
                    <input type="text" name="tele" value='<?php echo ($alumnoConsultado->getTelefono() !== NULL) ? $alumnoConsultado->getTelefono() : ""; ?>'><br>
                    <label for="">Foto</label><br>
                    <input type="file" name="foto"><br>
                    <input type="submit" value="Modificar" name="modificar">
                </form>
            </div>
        <?php
        }//END if
        ?>
        <div class="error">
            <h2><?php echo $error?></h2>
        </div>
    </div>
</div>

<?php
include 'Vistas/footer.php';