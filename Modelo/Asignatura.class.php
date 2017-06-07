<?php
require_once 'ObjetoComun.interface.php';
/**
 * Description of Asignatura
 *
 * @author usuario
 */
class Asignatura implements ObjetoComun{
    
    private $idAsignatura;
    private $nombre;
    
    public function __construct() {
        
    }
    
    public function getIdAsignatura() {
        return $this->idAsignatura;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setIdAsignatura($idAsignatura) {
        $this->idAsignatura = $idAsignatura;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function __toString() {
        
    }

}
