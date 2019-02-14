<?php
namespace Application\DbConnection;


use Manager\Db\Connect as ManagerConnect;
use Manager\Db\DbInterface;

/**
 *
 * @author Lenovo
 *        
 */
class ParentDao implements DbInterface
{
    
    protected $dbGateway;
    /**
     * ParentDao constructor.
     */
    public function __construct() {
         //put code to instantiate db connection
        $DB = new DBConnection();
        $this->dbGateway = $DB->DBConnect();
    }

    
    /**
     * @return \PDO
     */
    public function pdo() {
        $db = new \PDO('mysql:host='.$this->mySqlHost.';dbname='.$this->mySqlDbname,$this->mySqlUsername,$this->mySqlPassword);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    
    /**
     * @return Connect
     */
    public function connect($table = null) 
    {
        $db = new Connect();
        return $db->connect($table);
    }
    
    /**
     * @return Connect
     */
    /*public function connect(DbInterface $data) {
        return new ManagerConnect(array(
            'path'  => require __DIR__ . '/../../../../../config/autoload/global.php',
            'table' => $table
        ));
    }*/
    
}

