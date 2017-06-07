<?php
include 'Vistas/header.php';
?>

<div class="main-container">
    <div><h1>Configuración Usuario</h1></div>
    <div class="container">
        <!--Como el usuario que está registrado puede ser accedido desde aquí,
        simplemente muestro sus datos.-->
        <h1><img src="imagenes/<?php echo $usuarioCorrecto->getFoto(); ?>" alt="<?php echo $usuarioCorrecto->getFoto(); ?>"></h1>
        <h1>Login: <?php echo $usuarioCorrecto->getLogin(); ?></h1>
        <h1>Nombre: <?php echo $usuarioCorrecto->getNombre(); ?></h1>
        <h1>Pass: <?php echo $usuarioCorrecto->getPass(); ?></h1>
        <h1>Email: <?php echo $usuarioCorrecto->getEmail(); ?></h1>
    </div>
</div>

<?php
include 'Vistas/footer.php';