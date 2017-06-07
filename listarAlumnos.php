<?php
include 'Vistas/header.php';
?>
<div class="main-container">
    <div><h1>Lista Alumnos</h1></div>
    <div class="container">
        <?php
        //include 'DAO/MySQLDAO/MySQLDAOManager.class.php';
        require_once 'DAO/AppConfig.php';
        
        // Obtengo el Manager para poder utilizar los DAO.
        $daoManager = AppConfig::getInstance()->getDAOManager();
        $alumnoDAO = $daoManager->getAlumnoDAO();
        $rs = $alumnoDAO->consultarTodos();

        foreach ($rs as $value) {
        ?>
        <div class="listado">
            <div><img src="imagenes/<?php echo $value['FOTO']?>" alt="<?php echo $value['FOTO']?>"></div>
            <h2>Nombre: <?php echo $value['NOMBRE'] ?></h2>
            <h2>Número Expediente: <?php echo $value['NUMEXP'] ?></h2>
            <h2>DNI: <?php echo $value['DNI'] ?></h2>
            <h2>Telefono: <?php echo $value['TELEFONO'] ?></h2>
            <!--<h2>Foto: <?php echo $value['FOTO'] ?></h2>-->
        </div>
        <?php
        }//END foreach
        //Por último ciero la conexion utilizada.
        $alumnoDAO->cerrarConexion();
        ?>
    </div>
</div>

<?php
include 'Vistas/footer.php';
