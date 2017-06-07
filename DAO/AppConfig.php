<?php

require_once 'MySQLDAO/MySQLDAOManager.class.php';
/**
 * Clase Singleton para obtener los Manager de la base de datos.
 * El constructor es privado para que no se puedan crear objetos de él.
 *
 * @author Rodri
 */
class AppConfig {

    static private $instance = NULL;
    
    private function __construct() {
    }
    
    /**
     * Retorna una instancia de la propia clase.
     * 
     * Si es null la crea y la devuelve.
     * 
     * @return una instancia de la clase.
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new AppConfig();
        }
        return self::$instance;
    }
    
    /**
     * Devuelve un objeto que gestiona esa base de datos.
     * 
     * Si quisieramos utilizar otra base de datos, creariamos su manager y las clases
     * que gestionara y solo cambiariamos la línea del return. 
     * No cambiaría nada del resto del código.
     * 
     * @return un objeto de MySQLDAOManager
     */
    public function getDAOManager(){
        return new MySQLDAOManager();
    }
}