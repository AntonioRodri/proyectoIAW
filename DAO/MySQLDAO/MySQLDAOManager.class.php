<?php
require_once 'MySQLAlumnoDAO.class.php';
require_once 'MySQLUsuarioDAO.class.php';
require_once __DIR__.'/../IDAOManager.interface.php';
require_once __DIR__.'/../../config/config.php';

/**
 * Description of MySQLDAOManager
 *
 * @author Rodri
 */
class MySQLDAOManager implements IDAOManager{
    //Objeto de la conexión.
    private $connection;
    
    //DAO's concretos.
    private $alumnoDAO = NULL;
    private $usuarioDAO = NULL;
    
    function __construct() {
        $this->connection = new mysqli(HOST, USERNAME, PASS, DBNAME);
        $this->comprobarConexion($this->connection);
    }
    
    /**
     * Retorna una concreción del DAO
     * @return type
     */
    public function getAlumnoDAO() {
        if (is_null($this->alumnoDAO)) {
            $this->alumnoDAO = new MySQLAlumnoDAO($this->connection);
        }
        return $this->alumnoDAO;
    }
    
    /**
     * Retorna una concreción del DAO
     * @return type
     */
    public function getUsuarioDAO() {
        if (is_null($this->usuarioDAO)) {
            $this->usuarioDAO = new MySQLUsuarioDAO($this->connection);
        }
        return $this->usuarioDAO;
    }
    
    public function comprobarConexion(mysqli $connec) {
        if($connec->connect_error) {
            die("$connec->connect_errno: $connec->connect_error");
        }
}
}