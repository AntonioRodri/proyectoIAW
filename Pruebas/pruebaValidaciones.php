<?php

require_once __DIR__.'/../Modelo/Alumno.class.php';
require_once __DIR__.'/../Modelo/Usuario.class.php';

/////////////////////////// VALIDACIONES ALUMNO //////////////////////////////
$alumno1 = new Alumno();

//try {
//    $alumno1->setNumExp(123456);
//    $alumno1->setDni("12345678p");
//    $alumno1->setNombre("Ana");
//    $alumno1->setTelefono("123456789a");
//    $alumno1->setFoto("ana.jpg");
//    
//} catch (Exception $exc) {
//    echo $exc->getMessage();
//}



/////////////////////////// VALIDACIONES USUARIO //////////////////////////////
$usuario1 = new Usuario();

//try {
//    $usuario1->setLogin("login456");
//    $usuario1->setNombre("rodri1");
//    $usuario1->setEmail("rodri@gmail.com");
//    $usuario1->setPass("asdf");
//    $usuario1->setFoto("asd");
//    
//} catch (Exception $exc) {
//    echo $exc->getMessage();
//}