<?php
namespace Blockchain\Model;

/**
 *
 * @author Lenovo
 *        
 */
class Consensus
{

    /**
     */
    public function __construct()
    {
        //$this->blocks = new Blocks();
    }
    
    public function verify()
    {
        
    }
    
    public function compilation($blocks, $latestBlockHash)
    {
        $previousBlockJson = $blocks->getPreviousBlockContent($latestBlockHash);
        
        if($previousBlockJson['condition_consensus']){
            return true;
        }
    }
}

