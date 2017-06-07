<?php

require_once  __DIR__. '/../IAlumnoDAO.interface.php';
//require_once 'DAO/IAlumnoDAO.interface.php';
require_once  __DIR__.'/../../Modelo/Alumno.class.php';
/**
 * Description of MySQLAlumnoDAO
 *
 * @author Rodri
 */
class MySQLAlumnoDAO implements IAlumnoDAO{
    
    private $connection = null;
    
    function __construct(mysqli $connection) {
        $this->connection = $connection;
    }

    
    public function actualizar(ObjetoComun $alumno) {
        try {
            $stmt = $this->connection->prepare("UPDATE alumnos SET DNI= ?, NOMBRE = ?,TELEFONO= ?, FOTO= ? WHERE NUMEXP = ?");
        
            $numExp = $alumno->getNumExp();
            $dni = $alumno->getDni();
            $nombre = $alumno->getNombre();
            $telefono = $alumno->getTelefono();
            $foto = $alumno->getFoto();

            // Establecer los parametros.
            $stmt->bind_param('ssisi', $dni, $nombre, $telefono, $foto, $numExp);

            //Ejecutamos la sentencia preparada
            $ok = $stmt->execute();

            if ($ok) {
                $msg = 'Modificado correctamente';
            }else{
                $msg = 'Error.';
            }
            return $msg;
        } finally {
            $stmt->close();
        }
    }
    
    public function comprobarAlumno($numExp){
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(NUMEXP) OK FROM ALUMNOS WHERE NUMEXP = ?");
            // Establecer los parametros.
            $stmt->bind_param('i', $numExp);
            //Ejecuto la consulta después de indicar los parametros.
            $stmt->execute();
            //Obtengo el resultado de la consulta.
            $resultSet = $stmt->get_result();
            //Devulevo el resultado.
            if ($resultSet->fetch_array()['OK'] === 1) {
                return true;
            }
            else{
                return false;
            }
        } finally {
            $stmt->close();
            $resultSet->free();
        }
    }
    
    /**
     * 
     * @param String $alumnoNumExp
     * @return type
     */
    public function consultar($alumnoNumExp) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM ALUMNOS WHERE NUMEXP = ?");
//            $numExp = $alumno->getNumExp();
            // Establecer los parametros.
            $stmt->bind_param('i', $alumnoNumExp);
            //Ejecuto la consulta después de indicar los parametros.
            $stmt->execute();
            //Obtengo el resultado de la consulta.
            $resultSet = $stmt->get_result();
            //Devulevo el resultado.
            return $this->convertirAlumno($resultSet->fetch_array(MYSQLI_ASSOC));
        } finally {
            $stmt->close();
            $resultSet->free();
        }
    }
    
    /**
     * 
     * @return type
     */
    public function consultarTodos() {
        try {
//            $rs = $this->connection->query("SELECT * FROM ALUMNOS");
//            while ($row = $rs->fetch_array(MYSQLI_ASSOC)){
//                echo $row['NOMBRE'] . "<br>";
//            }
            return $this->connection->query("SELECT * FROM ALUMNOS");
        } finally {
//            $this->connection->close();
        }
    }

    public function crear(ObjetoComun $alumno) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO ALUMNOS (NUMEXP, DNI, NOMBRE, TELEFONO, FOTO) VALUES (?, ?, ?, ?, ?)");
        
            $numExp = $alumno->getNumExp();
            $dni = $alumno->getDni();
            $nombre = $alumno->getNombre();
            $telefono = $alumno->getTelefono();
            $foto = $alumno->getFoto();

            // Establecer los parametros.
            $stmt->bind_param('issis',$numExp, $dni, $nombre, $telefono, $foto);

            //Ejecutamos la sentencia preparada
            $ok = $stmt->execute();

            if ($ok) {
                $msg = 'Insertado correctamente';
            }else{
                $msg = 'Error.';
            }
            return $msg;
        } finally {
            $stmt->close();
        }
    }

    public function eliminar(ObjetoComun $alumno) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM ALUMNOS WHERE NUMEXP = ?");
            $numExp = $alumno->getNumExp();
            // Establecer los parametros.
            $stmt->bind_param('i', $numExp);
            //Ejecutamos la sentencia preparada
            $ok = $stmt->execute();
            if ($ok) {
                $msg = 'Eliminado correctamente';
            }else{
                $msg = 'Error al eliminar.';
            }
            return $msg;
        } finally {
            $stmt->close();
        }
    }
    
    public function convertirAlumno($arrayAlumno) {
        $alumno = new Alumno();
        
        $alumno->setNumExp($arrayAlumno['NUMEXP']);
        $alumno->setDni($arrayAlumno['DNI']);
        $alumno->setNombre($arrayAlumno['NOMBRE']);
        $alumno->setTelefono($arrayAlumno['TELEFONO']);
        $alumno->setFoto($arrayAlumno['FOTO']);
        
        return $alumno;
    }
    
    
    public function cerrarConexion() {
        $this->connection->close();
    }
    
    /**
     * Función que consulta las asignaturas del alumno que se le pasa su NUMEXP 
     * por parametro.
     * 
     * @param type $numExp
     * @return type
     */
    public function consultarAsignaturas($numExp) {
        $sql = "SELECT asignaturas.NOMBRE, notas.NOTA FROM notas, asignaturas WHERE notas.ID_ASIGNATURA = asignaturas.ID_ASIGNATURA AND notas.ID_ALUMNO = ?";
        try {
            $stmt = $this->connection->prepare($sql);
            // Establecer los parametros.
            $stmt->bind_param('i', $numExp);
            //Ejecutamos la sentencia preparada
            $stmt->execute();
            // Devuelvo el objeto mysqli_result
            return $stmt->get_result();
        } finally {
            $stmt->close();
        }
    }
}