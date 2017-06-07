<?php
require_once 'ObjetoComun.interface.php';

/**
 * Description of Usuario
 *
 * @author Rodri
 */
class Usuario implements ObjetoComun{
    
    private $nombre;
    private $login;
    private $pass;
    private $email;
    private $foto;
    
    function __construct() {
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getLogin() {
        return $this->login;
    }

    function getPass() {
        return $this->pass;
    }

    function getEmail() {
        return $this->email;
    }

    function getFoto() {
        return $this->foto;
    }

    public function setNombre($nombre) {
        if (!ctype_alpha($nombre) || trim(empty($nombre))) {
            throw new Exception('Error en el nombre. No puede contener numeros o estar vacio.');
        }
        $this->nombre = $nombre;
    }

    function setLogin($login) {
        if (trim(empty($login))) {
            throw new Exception('Error en el login. No puede estar vacio.');
        }
        $this->login = $login;
    }

    function setPass($pass) {
        if (trim(empty($pass))) {
            throw new Exception('Error en el pass. No puede estar vacio.');
        }
        $this->pass = sha1($pass);
    }

    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || trim(empty($email))) {
            throw new Exception('Error en el email. No puede estar vacio y cumplir el estandar del email.');
        }
        $this->email = $email;
    }

    public function setFoto($foto) {
        if (trim(empty($foto))) {
            throw new Exception('Error en el foto. No puede estar vacio.');
        }
        $this->foto = $foto;
    }

    public function __toString() {
        return implode(" - ",get_object_vars($this));
    }
}