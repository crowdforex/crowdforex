<?php
namespace Blockchain\Model\Consensus;

use Blockchain\Model\Mapper\ConsensusBlockMapper;

/**
 *
 * @author Lenovo
 *        
 */
class Block
{

    /**
     */
    public function __construct()
    {
        $this->mapper = new ConsensusBlockMapper();
    }
    
    public static function mine($block)
    {
        if($block > 000){
            for($i = 0; $i < 100; $i++){
                hash_hmac('sha256', $block, $i);
            }
        }
    }
    
    public function proof()
    {
        
    }
}

