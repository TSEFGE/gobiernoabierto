<?php

include_once __DIR__ .'/../init.php';

/**
 * This class implements the singleton pattern to return configuration values 
 * without opening and closing the file every time needed.
 * 
 */
class FGEConfiguration {
    
    //The reference to the file
    private $file_ini;
    
    //The ¡nstance of the class that will be returned when needed.
    private static $instance = NULL;
    
    /** Constructor of the class.*/
    private function __construct() {
        $this->file_ini = parse_ini_file(__CONFIG_FILE_INI__, true);
    }
    
    /** Singleton method, returns an instance of this class. */
    public static function getInstance(){
        if(self::$instance == NULL){
            self::$instance = new FGEConfiguration();
        }
        return self::$instance;
    }
    
    /**
     * This method returns the value set in the config file.
     * @param type $section optional, the section to which the config property belongs to.
     * @param type $name The name of the property.
     * 
     * @return string returns an string with the value obtained from the config file. if the value is not in the file returns NULL.
     */
    public function get($section, $name){
        return isset($this->file_ini[$section][$name]) ? 
            $this->file_ini[$section][$name] : '';
    }
    
 }
?>
