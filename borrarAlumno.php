<?php
$error = "";
    // Si viene algo del formulario, entonces hago esto. Sino no.
    if (filter_input(INPUT_POST, "baja") != NULL) { 
        require_once  'DAO/AppConfig.php';
        $daoManager = AppConfig::getInstance()->getDAOManager();
        $alumnosDAO = $daoManager->getAlumnoDAO();
        // Obtengo ek valor del input
        $numExp = filter_input(INPUT_POST, "numexp");
        
        if ($alumnosDAO->comprobarAlumno($numExp)) {
            $alumnoConsultado = $alumnosDAO->consultar($numExp);
            $error = $alumnosDAO->eliminar($alumnoConsultado);
            //Por último ciero la conexion utilizada.
            $alumnoDAO->cerrarConexion();
        }else{
            $error = "Ese Alumno no existe, no se puede borrar.";
        }
    }
?>
<?php
include 'Vistas/header.php';
?>

<div class="main-container">
    <div><h1>Borrar Alumnos</h1></div>
    <div class="container">
        <form action="" method="POST">
            <label for="">Número de Expediente</label><br>
            <input type="text" name="numexp"><br>
            <input type="submit" value="Dar de baja" name="baja">
        </form>
        <div class="error">
            <h2><?php echo $error?></h2>
        </div>
    </div>
</div>

<?php
include 'Vistas/footer.php';