<?php
require_once 'ObjetoComun.interface.php';

/**
 * Description of Notas
 *
 * @author usuario
 */
class Notas implements ObjetoComun {
    
    private $idNota;
    private $idAlumnos;
    private $idAsignatura;
    private $fecha;
    private $nota;
    
    public function __construct() {
        
    }
    
    public function getIdNota() {
        return $this->idNota;
    }

    public function getIdAlumnos() {
        return $this->idAlumnos;
    }

    public function getIdAsignatura() {
        return $this->idAsignatura;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getNota() {
        return $this->nota;
    }

    public function setIdNota($idNota) {
        $this->idNota = $idNota;
    }

    public function setIdAlumnos($idAlumnos) {
        $this->idAlumnos = $idAlumnos;
    }

    public function setIdAsignatura($idAsignatura) {
        $this->idAsignatura = $idAsignatura;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setNota($nota) {
        $this->nota = $nota;
    }
    
    public function __toString() {
        
    }
}