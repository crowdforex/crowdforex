<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blockchain\Model\Block;
use Blockchain\Api\Blockchain;
use Blockchain\Model\HashTx;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        /**$block = new Block();
        $tx = new HashTx();
        $ticket = json_encode(array(
                'previous_block' => 0,
                'id' => 0,
                'transaction_hash' => '',
                'address' => 'NjYyMDQ5MTY4',
                'bitcoin_address' => '122PKv1ekCwMffhiXCfoUC6ARCwH7hSVji',
                'ticket_thousand' => '7146',
                'coin' => 'BTC',
                'amount' => '0.001',
                'status' => 'Pending',
                'date_open_transaction' => '2019-01-05 16:28:10',
                'date_executed_transaction' => ''
            
            ));
        $decode = json_decode($ticket, true);
        $encode = base64_encode($ticket);
        
        $tx = $tx->create(array(
            'content' => $encode,
            'tx' => array(
                $decode['date_open_transaction'].
                $decode['ticket_thousand']
            ),
            'path' => 'data/blockchain/tx/',
            
        ));
        echo var_dump($block->generator(array(
            'path' => 'data/blockchain/blocks/',
            'previousHash' => 0,
            'content' => $tx,
            'blockchainTransaction' => '0e3e2357e806b6cdb1f70b54c3a3a17b6714ee1f0e68bebb44a74b1efd512098'
        )));*/
        
        return new ViewModel();
    }
    
    public function balanceAction()
    {
        $file = file_get_contents('data/blockchain/blocks/92d18792ed6dafe45b832f4f1d9bdb5852bf41e0abb95e206b1597f54093b3255fdfe387df4db98d75d93d7e939fcb803142e8f894f5edc15792e8d9c51008ea.json');
        return var_dump(json_decode(base64_decode($file)));
    }
}
