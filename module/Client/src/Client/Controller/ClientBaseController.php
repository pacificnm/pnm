<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Client\Entity\ClientEntity;

class ClientBaseController extends BaseController
{

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

    
    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $clientId = $this->params()->fromRoute('clientId');
        
        // get client
        $clientEntity = $this->getClient($clientId);
        
        // set layout up
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->clientId = $clientId;
        
        $this->clientEntity = $clientEntity;
    }
}