<?php
namespace Blockchain\Model;

use Application\DbConnection\ParentDao;
use Blockchain\Api\Blockchain;
use Blockchain\Model\Mapper\BlockchainMapper;

/**
 *
 * @author Lenovo
 *        
 */
class Blocks extends ParentDao
{

    /**
     */
    public function __construct()
    {
        $this->blocks = $this->connect('blocks');
        $this->block = new Block();
        $this->api = new Blockchain();
        $this->mapper = new BlockchainMapper();
        
    }
    
    /**
     * 
     */
    public function insertOnBlock($data)
    {
        $this->mapper->getData($data);
        
        $encode = $this->_content();
        $jsonDecode = $this->_contentDecode();
        $previousBlockJson = $this->getPreviousBlockContent($this->latestBlockHash());
        
        $this->block->create(array(
            'previousHash' => $this->latestBlockHash(),
            'transactions' => $encode
        ));
        
        if($this->block->mapper->getPreviousHash() == null){
            $bitcoinAddress = $jsonDecode['wallet_address'];
        }
        else{
            $bitcoinAddress = $previousBlockJson['wallet_address'];
        }
        
        $blockchain = json_encode($this->api->Explorer->getTransaction($this->mapper->getBlockchainTransaction()));
        $blockchain = json_decode($blockchain, true);
        echo var_dump($previousBlockJson);   
        if($blockchain['block_height'] != null){
            if($blockchain['time'] <= strtotime($jsonDecode['date_open_transaction'].'+1 hour') &&
                $jsonDecode['wallet_address'] == $bitcoinAddress
                ){ 
                    return $this->blocks->data->insert(array(
                        'previous_block' => $this->block->mapper->getPreviousHash(),
                        'hash' => $this->block->mapper->getBlockHash(),
                        'block_index' => 1,
                        'data' => $encode
                    ));
            }
        }
    }
    
    /**
     * 
     */
    public function downloadBlocks($data)
    {
        $this->mapper->getData($data);
        
        $encode = $this->_content();
        $jsonDecode = $this->mapper->getContent();
        //$previousBlockJson = $this->getPreviousBlockContent($this->latestBlockHash());
        for($i=0; $i<sizeof($jsonDecode); $i++){
            $p += $i;
            if($this->get('hash') == null){
                $this->block->create(array(
                    'previousHash' => 0,
                    'transactions' => $jsonDecode[$i]['data']
                ));
            }else{
                $this->block->create(array(
                    'previousHash' => $this->latestBlockHash(),
                    'transactions' => $jsonDecode[$i]['data']
                ));
            }
            if($this->block->mapper->getBlockHash() == $jsonDecode[$i]['hash']){
                if($this->get('hash', array(
                    'hash' => $jsonDecode[$i]['hash']
                )) ==  null){
                    $this->blocks->data->insert(array(
                        'previous_block' => $jsonDecode[$i]['previous_block'],
                        'hash' => $jsonDecode[$i]['hash'],
                        'block_index' => $jsonDecode[$i]['block_index'],
                        'data' => $jsonDecode[$i]['data']
                    ));
                }
            }
        }
        
    }
    
    /**
     * 
     */
    private function _content()
    {
        $encode = null;
        
        //if(is_array($this->mapper->getContent())){
            $json = json_encode($this->mapper->getContent());
            $encode = base64_encode($json);
        //}
        
        return $encode;
    }
    
    /**
     * 
     * @return mixed
     */
    private function _contentDecode()
    {
        $json = base64_decode($this->_content());
        $json = json_decode($json, true);
        return $json;
    }
    
    /**
     * 
     * @return number
     */
    public function latestBlockHash()
    {
        $hash = 0;
        
        if($this->get('hash') != null){
            $hash = $this->get('hash');
        }
        
        return $hash;
    }
    
    
    
    /**
     * 
     * @param unknown $field
     * @param array $where
     * @return unknown
     */
    public function get($field, $where = array())
    {
        
        $select = $this->blocks->get($where);
        
        foreach($select as $key){
            $id = $key[$field];
            
        }
        
        return $id;
    }
    
    /**
     *
     * @return number
     */
    public function getPrize()
    {
        $previousBlockJson = $this->getPreviousBlockContent($this->latestBlockHash());
        
        $prize = json_encode($this->api->Explorer->getAddress($previousBlockJson['wallet_address']));
        $prize = json_decode($prize, true);
        //echo var_dump($previousBlockJson['wallet_address']);
        return $prize['final_balance'] * 0.75;
    }
    
    /**
     *
     * @return mixed
     */
    public function getPreviousBlockContent($block)
    {
        $json = null;
        
        $previousBlock = $this->get('data', array(
            'hash' => $block
        ));
        $decode = base64_decode($previousBlock);
        $json = json_decode($decode, true);
        
        return $json;
    }
}

