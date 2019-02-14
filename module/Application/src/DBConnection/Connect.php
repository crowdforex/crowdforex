<?php
namespace Application\DbConnection;

use Manager\Db\DbInterface;
use Manager\Db\Connect as ManagerConnect;

class Connect implements DbInterface
{
    
    public $config = __DIR__ . '/../../../../config/autoload/global.php';
    
    public function __construct()
    {
        
    }
    
    public function dbConnect()
    {
        
    }
    /*
     * @Return new ManagerConnect
     */
    public function connect($table)
    {
        if(!file_exists($this->config)){
            return header('Location: /install');
        }
        return new ManagerConnect(array(
            'path'  => require $this->config,
            'table' => $table
        ));
    }
    
    /*
     * @Return ConnectMysqli
     */
    public function connectMysqli($data)
    {
        return new ManagerConnect($data);
    }
    
    /*
     * @Return ConnectPdo
     */
    public function connectPdo($data)
    {
        return new ManagerConnect($data);
    }
    
}

