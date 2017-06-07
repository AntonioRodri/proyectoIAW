<?php
require_once 'ObjetoComun.interface.php';
/**
 * Description of Alumno
 *
 * @author Rodri
 */
class Alumno implements ObjetoComun {
    
    private $numExp;
    private $dni;
    private $nombre;
    private $telefono;
    private $foto;
    
    function __construct() {
    }
    
    public function getNumExp() {
        return $this->numExp;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setNumExp($numExp) {
        if (!ctype_digit($numExp) || trim(empty($numExp))) {
            throw new Exception('Error en el Numero de Expediente. No puede estar vacio y deben ser números');
        }
        $this->numExp = $numExp;
    }

    public function setDni($dni) {
        if (trim(empty($dni)) || !strlen($dni) === 9 || !ctype_digit(substr($dni, 0, -1)) || !ctype_alpha(substr($dni, -1))){
            throw new Exception('Error en el DNI. Debe de cumplir el estandar 8 numeros y 1 letra.');
		}
        $this->dni = $dni;
    }

    public function setNombre($nombre) {
        if (!ctype_alpha($nombre) || trim(empty($nombre))) {
            throw new Exception('Error en el nombre.');
        }
        $this->nombre = $nombre;
    }

    public function setTelefono($telefono) {
        if (trim(empty($telefono)) || strlen($telefono) !== 9 || !ctype_digit($telefono)){
            throw new Exception('Error en el Telefono. El telefono no puede estar vacio, debe tener 9 digitos y ser numeros.');
		}
        $this->telefono = $telefono;
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