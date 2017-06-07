<?php
$error = "";
$ver = FALSE;
    // Si viene algo del formulario, entonces hago esto. Sino no.
    if (filter_input(INPUT_POST, "consultar") != NULL) { 
        require_once  'DAO/AppConfig.php';
        $daoManager = AppConfig::getInstance()->getDAOManager();
        $alumnosDAO = $daoManager->getAlumnoDAO();
        // Obtengo ek valor del input
        $numExp = filter_input(INPUT_POST, "numexp");
        
        if ($alumnosDAO->comprobarAlumno($numExp)) {
            $alumnoConsultado = $alumnosDAO->consultar($numExp);
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
    <div><h1>Asignaturas</h1></div>
    <div class="container">
        <form action="" method="POST">
            <label for="">Número de Expediente</label><br>
            <input type="text" name="numexp"><br>
            <input type="submit" value="Consultar" name="consultar">
        </form>
        <?php
        // Para mostrar la tabla si existe el alumno
        if ($ver) {
        ?>
            <div>
                <h2>Nombre: <?php echo $alumnoConsultado->getNombre()?></h2>
                <h2>DNI: <?php echo $alumnoConsultado->getDni()?></h2>
                <table>
                    <tr>
                        <th>Asignatura</th>
                        <th>Nota</th>
                    </tr>
                <?php
                foreach ($alumnosDAO->consultarAsignaturas($numExp) as $value) {
                    echo '<tr>';
                    echo '<td>'.$value['NOMBRE'] . "</td>";
                    echo '<td>'.$value['NOTA'] . "</td>";
                    echo '</tr>';
                }
                ?>
                </table>
            </div>
        <?php
        //Por último ciero la conexion utilizada.
            $alumnosDAO->cerrarConexion();
        }//END if
        ?>
        <div class="error">
            <h2><?php echo $error?></h2>
        </div>
    </div>
</div>

<?php
include 'Vistas/footer.php';