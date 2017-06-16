<?php
include_once __DIR__.'/../init.php';
include_once __HELPER_PATH__.'/FGEConfiguration.php';

class GenericDAO {

    private $logger = NULL;
    
    protected $pdo_obj = NULL;     // Stores the open connection PDO object
    private $connection_string = NULL; // Used to build the database connection
    private $db_type = NULL;   // Stores the database type
    private $db_host = NULL;
    private $db_user = NULL;
    private $db_pass = NULL;
    private $db_name = NULL;
    private $db_charset = NULL;
    private $is_active = false;               // Checks to see if the connection is active

    protected $pdo_obj_rr = NULL;     // Stores the open connection PDO object
    private $connection_string_rr = NULL; // Used to build the database connection
    private $db_type_rr = NULL;   // Stores the database type
    private $db_host_rr = NULL;
    private $db_user_rr = NULL;
    private $db_pass_rr = NULL;
    private $db_name_rr = NULL;
    private $db_charset_rr = NULL;
    private $is_active_rr = false;               // Checks to see if the connection is active

    public function __construct() {
        $config = FGEConfiguration::getInstance();
        $this->logger = Logger::getLogger("GenericDAO");
        $this->db_host = $config->get('database', 'host');
        $this->db_user = $config->get('database', 'username');
        $this->db_pass = $config->get('database', 'password');
        $this->db_name = $config->get('database', 'dbname');
        $this->db_type = $config->get('database', 'mysql');
        $this->db_charset = $config->get('database', 'charset');
        $this->connection_string = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name;

        $this->db_host_rr = $config->get('database', 'host');
        $this->db_user_rr = $config->get('database', 'username');
        $this->db_pass_rr = $config->get('database', 'password');
        $this->db_name_rr = $config->get('database', 'dbname');
        $this->db_type_rr = $config->get('database', 'mysql');
        $this->db_charset_rr = $config->get('database', 'charset');
        $this->connection_string_rr = "mysql:host=" . $this->db_host_rr . ";dbname=" . $this->db_name_rr;

        return $this;
    }

    /*
     * only one connection allowed
     */
    protected function connect() {
        if (!$this->is_active) {
            try {
                $attrs = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET charset " . $this->db_charset
                );
                $this->pdo_obj = new PDO($this->connection_string, $this->db_user, $this->db_pass, $attrs);
                $this->pdo_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $this->is_active = true;
            } catch (PDOException $e) {
                $this->logger->error("ERROR:" . $e->getMessage());
                $this->logger->error("ERROR:" . $e->getTraceAsString());
                throw $e;
            }
        }
        return $this->is_active;
    }

    protected function connect_rr(){        
        if (!$this->is_active_rr) {
            try {
                $attrs = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET charset " . $this->db_charset_rr
                );
                $this->pdo_obj_rr = new PDO($this->connection_string_rr, $this->db_user_rr, $this->db_pass_rr, $attrs);
                $this->pdo_obj_rr->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $this->is_active_rr = true;
            } catch (PDOException $e) {
                $this->logger->error("ERROR:" . $e->getMessage());
                $this->logger->error("ERROR:" . $e->getTraceAsString());
                throw $e;
            }
        }
        return $this->is_active_rr;
    }

    protected function disconnect() {
        $isDisconnect = false;
        if ($this->is_active) {
            unset($this->pdo_obj);
            $this->is_active = false;
            $isDisconnect = true;
        }
        return $isDisconnect;
    }

     protected function disconnect_rr() {
        $isDisconnect = false;
        if ($this->is_active_rr) {
            unset($this->pdo_obj_rr);
            $this->is_active_rr = false;
            $isDisconnect = true;
        }
        return $isDisconnect;
    }

    /*
     * SELECT (any)
     * Required: $sqlSelect
     */
    public function select($sqlSelect) {
        $this->connect_rr();
        $exception = NULL;
        $arrayResult = NULL;
        try {
            $sql = $this->pdo_obj_rr->prepare($sqlSelect);
            $sql->execute();
            $arrayResult = $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $exception = $e;
            $this->logger->error("ERROR:" . $e->getMessage());
            $this->logger->error("ERROR:" . $e->getTraceAsString());
        } 
        $this->disconnect_rr();
        if($exception){
            throw $exception;
        }            
        return $arrayResult;
    }
    
    

    /*
     * INSERT
     * Required: $strInsert sql insert
     */
    public function insert($strInsert, $getLastId = FALSE) {
        $exception = NULL;
        $totalRows = -1;
        $this->connect();
        try {
            $ins = $this->pdo_obj->prepare($strInsert);
            $ins->execute();
            if ($getLastId) {
                $totalRows = $this->pdo_obj->lastInsertId();
            } else {
                $totalRows = $ins->rowCount();
            }
        } catch (PDOException $e) {
            $this->logger->error("ERROR:" . $e->getMessage());
            $this->logger->error("ERROR:" . $e->getTraceAsString());
            $exception = $e;
        } 
        $this->disconnect();
        if($exception){
            throw $e; 
        }
        return $totalRows;
    }

    /*
     * DELETE
     * Required: Stament to sql delete
     */

    public function delete($strDelete) {
        $exception = NULL;
        $totalRows = -1;
        $this->connect();
        try {
            $del = $this->pdo_obj->prepare($strDelete);
            $del->execute();
            $totalRows = $del->rowCount();
        } catch (PDOException $e) {
            $this->logger->error("ERROR:" . $e->getMessage());
            $this->logger->error("ERROR:" . $e->getTraceAsString());
            $exception = $e; 
        }
        $this->disconnect();
        if($exception){
            throw $e; 
        }
        return $totalRows;
    }

    /*
     * UPDATE
     * Required: $strUpdate
     */
    public function update($strUpdate) {
        $exception = NULL;
        $totalRows = -1;
        $this->connect();
        try {
            $upd = $this->pdo_obj->prepare($strUpdate);
            $upd->execute();
            $totalRows = $upd->rowCount();            
        } catch (Exception $e) {
            $this->logger->error("ERROR:" . $e->getMessage());
            $this->logger->error("ERROR:" . $e->getTraceAsString());
            $exception = $e; 
        }
        $this->disconnect();
        
        if($exception){
            throw $e;
        }
        return $totalRows;
    }
}

?>
