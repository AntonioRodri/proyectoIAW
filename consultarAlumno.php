<?php
    $error = "";
    $ver = FALSE;
    if (filter_input(INPUT_POST, 'consultar') !== NULL) {
        require_once  'DAO/AppConfig.php';
        $daoManager = AppConfig::getInstance()->getDAOManager();
        $alumnosDAO = $daoManager->getAlumnoDAO();
        
        $numExp = filter_input(INPUT_POST, 'numexp');
        
        if ($alumnosDAO->comprobarAlumno($numExp)) {
            $alumnoConsultado = $alumnosDAO->consultar($numExp);
            //Por último ciero la conexion utilizada.
            $alumnosDAO->cerrarConexion();
            $ver = TRUE;
        }else{
            $error = "Ese Alumno no existe.";
        }
    }

?>
<?php
include 'Vistas/header.php';
?>

<div class="main-container">
    <div><h1>Consultar Alumnos</h1></div>
    <div class="container">
        <form action="" method="POST">
            <label for="">Número de Expediente</label><br>
            <input type="text" name="numexp"><br>
            <input type="submit" value="Consultar" name="consultar">
        </form>
        <div class="error">
            <?php 
            if ($ver) {
            ?>
            <h2>Nombre: <?php echo $alumnoConsultado->getNombre() ?></h2>
            <h2>Número Expediente: <?php echo $alumnoConsultado->getNumExp() ?></h2>
            <h2>DNI: <?php echo $alumnoConsultado->getDni() ?></h2>
            <h2>Telefono: <?php echo $alumnoConsultado->getTelefono() ?></h2>
            <h2>Foto: <?php echo $alumnoConsultado->getFoto()?></h2>
            <?php  
            }
            ?>
        </div>
        <div class="error">
            <h2><?php echo $error?></h2>
        </div>
    </div>
</div>

<?php
include 'Vistas/footer.php';