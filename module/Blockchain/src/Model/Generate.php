<?php
namespace Connections\Blockchain\Model;

use Connections\Blockchain\Model\Mapper\GenerateMapper;

/**
 *
 * @author Lenovo
 *        
 */
class Generate
{

    
    
    /**
     */
    public function __construct(array $data)
    {
        $this->mapper = new GenerateMapper();
        
        $this->mapper->getData($data);
    }
    
    public function run()
    {
        
        
    }
}

