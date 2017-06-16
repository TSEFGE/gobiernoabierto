<?php
//Root path of the application.
define('__ROOT_PATH__', __DIR__);

//Path to the Config folder.
define('__CONFIG_PATH__', __ROOT_PATH__ . '/configs');

//Path to the veo-config.ini file.
define('__CONFIG_FILE_INI__', __CONFIG_PATH__ . '/fge_desaparecidos.ini');
        
//Path to the helper class
define('__HELPER_PATH__', __ROOT_PATH__ . '/helpers');

//Path to the log files
define('__LOGGER_FILE_APP__', __ROOT_PATH__ . '/logs/desaparecidos.log');

//Path to the library class
define('__LIBRARY_PATH__', __ROOT_PATH__ . '/vendor');

//Path to the dao class
define('__DATA_PATH__', __ROOT_PATH__ . '/data');
        
//Include logger and initialize it
include_once __LIBRARY_PATH__.'/log4php/Logger.php';
Logger::configure(__CONFIG_PATH__.'/config.xml');

?>
