<?php
require_once  __DIR__.'/../IUsuarioDAO.interface.php';
require_once  __DIR__.'/../../Modelo/Usuario.class.php';
/**
 * Description of MySQLUsuarioDAO
 *
 * @author Rodri
 */
class MySQLUsuarioDAO implements IUsuarioDAO{
    
    private $connection = null;
    
    function __construct(mysqli $connection) {
        $this->connection = $connection;
    }
    
    /**
     * 
     * @param ObjetoComun $usuario
     */
    public function actualizar(ObjetoComun $usuario) {
        throw new Exception("Método no definido.");
    }
    
    public function comprobarLoginUsuario($login){
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(LOGIN) OK FROM USUARIOS WHERE LOGIN = ?");
            // Establecer los parametros.
            $stmt->bind_param('s', $login);
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
    
    public function comprobarEmailUsuario($email){
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(LOGIN) OK FROM USUARIOS WHERE EMAIL = ?");
            // Establecer los parametros.
            $stmt->bind_param('s', $email);
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
    
    
    
    public function comprobarUsuario($login, $pass){
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(LOGIN) OK FROM USUARIOS WHERE LOGIN = ? AND PASS = ?");
            // Establecer los parametros.
            $stmt->bind_param('ss', $login, $pass);
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
            //$resultSet->free();
        }
    }


    /**
     * 
     * @param ObjetoComun $usuarioLogin
     * @return El usuario o NULL si no existe.
     */
    public function consultar($usuarioLogin) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM USUARIOS WHERE LOGIN = ?");
//            $login = $usuario->getLogin();
            // Establecer los parametros.
            $stmt->bind_param('s', $usuarioLogin);
            //Ejecuto la consulta después de indicar los parametros.
            $stmt->execute();
            //Obtengo el resultado de la consulta.
            $resultSet = $stmt->get_result();
            //Devulevo el resultado.
            return $this->convertirUsuario($resultSet->fetch_array(MYSQLI_ASSOC));
        } finally {
            $stmt->close();
            $resultSet->free();
        }
    }
    
    /**
     * 
     */
    public function consultarTodos() {
        try {
            return $this->connection->query("SELECT * FROM usuarios");
        } finally {
        }
    }
    
    /**
     * Introduce en la base de datos un usuario que le llega por parámetro.
     * 
     * @param ObjetoComun $usuario
     * @return string
     */
    public function crear(ObjetoComun $usuario) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO usuarios (LOGIN, NOMBRE, PASS, EMAIL, FOTO) VALUES (?, ?, ?, ?, ?)");
            $login = $usuario->getLogin();
            $nombre = $usuario->getNombre();
            $pass = $usuario->getPass();
            $email = $usuario->getEmail();
            $foto = $usuario->getFoto();
            // Establecer los parametros.
            $stmt->bind_param('sssss', $login, $nombre, $pass, $email, $foto);
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
    
    /**
     * Elimina el usuario que llega por parametro.
     * 
     * Este método solo se llama si el usuario existe.
     * 
     * @param ObjetoComun $usuario
     * @return string
     */
    public function eliminar(ObjetoComun $usuario) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM usuarios WHERE LOGIN = ?");
            $login = $usuario->getLogin();
            // Establecer los parametros.
            $stmt->bind_param('s', $login);
            //Ejecutamos la sentencia preparada
            $ok = $stmt->execute();
            if ($ok) {
                $msg =  'Eliminado correctamente';
            }else{
                $msg = 'Error al eliminar.';
            }
            return $msg;
        } finally {
            $stmt->close();
        }
    }
    
    /**
     * Convierte a un objeto Usuario un array que le llega por parametro con los
     * datos del usuario.
     * 
     * @param type $arrayUsuario -> usuario en un array
     * @return Objeto Usuario obtenido de la información del Array.
     */
    public function convertirUsuario($arrayUsuario){
        $usuario = new Usuario();
        
        $usuario->setLogin($arrayUsuario['LOGIN']);
        $usuario->setNombre($arrayUsuario['NOMBRE']);
        $usuario->setPass($arrayUsuario['PASS']);
        $usuario->setEmail($arrayUsuario['EMAIL']);
        $usuario->setFoto($arrayUsuario['FOTO']);
       
       return $usuario;
    }
    
    
    public function cerrarConexion() {
        $this->connection->close();
    }
}