<?php
//Esto mejor incluirlo en el header.php
    require_once  __DIR__.'/../DAO/AppConfig.php';
    require_once  __DIR__.'/../Modelo/Usuario.class.php';

    $daoManager = AppConfig::getInstance()->getDAOManager();

    $alumnoDAO = $daoManager->getAlumnoDAO(); //DAO alumnos
    $usuarioDAO = $daoManager->getUsuarioDAO(); //DAO usuario
    
//    //////////////////// USUARIO DE PRUEBA /////////////////////////////
//    $usuario1 = new Usuario();
//    
//    $usuario1->setLogin("ana66");
//    $usuario1->setNombre("Ana");
//    $usuario1->setPass("12345678");
//    $usuario1->setEmail("ana@gmail.com");
//    $usuario1->setFoto("ana.jpg");
    
    
///////////////// CONSULTAR TODOS USUARIOS ////////////////////////
//    $rs = $usuarioDAO->consultarTodos();
//    
//    foreach ($rs as $value) {
//        echo $value['NOMBRE'] . '<br>';
//    }
//    
////    while ($row = $rs->fetch_array(MYSQLI_ASSOC)){
////        echo $row['NOMBRE'] . "<br>";
////    }
    
    //////////////////// ELIMINAR USUARIO /////////////////////////////
    //1º comprobar que existe con consultar y despues eliminarlo si existe.
    
//    if (is_null($usuarioDAO->consultar($usuario1)->getNombre())) {
//        echo 'No existe, no se puede borrar <br>';
//    }else {
//        echo 'Existe, borrado <br>';
//        $resultado = $usuarioDAO->eliminar($usuario1);
//        echo $resultado;
//    }
    
    ///////////////////// CONSULTAR USUARIO ////////////////////////////////
//    $resultado = $usuarioDAO->consultar($usuario1);
//    
//    var_dump($resultado);
//    
//    echo '<br><br>';
//    
//    if (is_null($resultado->getNombre())) {
//        echo 'No existe <br>';
//    }else {
//        echo 'Existe <br>';
//    }
    /////////////////// CREAR USUARIO/////////////////////////////
//    $resultado = $usuarioDAO->crear($usuario1);
    
//    echo $resultado;
    
    /////////////////////////////////////////////////////////////////////////////
    //////////////////// USUARIO DE PRUEBA /////////////////////////////
//    $alumno1 = new Alumno();
//    
//    $alumno1->setNumExp(123456);
//    $alumno1->setDni("12345678F");
//    $alumno1->setNombre("Ana");
//    $alumno1->setTelefono(36985248);
//    $alumno1->setFoto("ana.jpg");
   ///////////////// CONSULTAR TODOS ALUMNOS ////////////////////////
//    $rs = $alumnoDAO->consultarTodos();
//    
//    foreach ($rs as $value) {
//        echo $value['NOMBRE'] . '<br>';
//    }
    
//    while ($row = $rs->fetch_array(MYSQLI_ASSOC)){
//        echo $row['NOMBRE'] . "<br>";
//    }
    
        ///////////////////// CONSULTAR ALUMNOS ////////////////////////////////
//    $resultado = $alumnoDAO->consultar($alumno1);
//    
//    var_dump($resultado);
//    echo '<br><br>';
//    if (is_null($resultado->getNombre())) {
//        echo 'No existe <br>';
//    }else {
//        echo 'Existe <br>';
//    }
        /////////////////// CREAR ALUMNO /////////////////////////////
        //CREAR ALUMNO SI NO EXISTE
//    $resultado = $alumnoDAO->crear($alumno1);
//    
//    echo $resultado;
    
        //////////////////// ELIMINAR ALUMNO /////////////////////////////
    //1º comprobar que existe con consultar y despues eliminarlo si existe.
    
//    if (is_null($alumnoDAO->consultar($alumno1)->getNombre())) {
//        echo 'No existe, no se puede borrar <br>';
//    }else {
//        echo 'Existe, borrado <br>';
//        $resultado = $alumnoDAO->eliminar($alumno1);
//        echo $resultado;
//    }
    ////////////////////////////////////////////////////////////////////////
    
//    $comprobado = $alumnoDAO->consultar("666666");
////    var_dump($comprobado);
//    
//    echo $alumnoDAO->eliminar($comprobado);