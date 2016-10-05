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
     * @var number
     */
    protected $page;
    
    /**
     * 
     * @var number
     */
    protected $countPerPage;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $page = $this->params()->fromQuery('page', 1);
        
        $countPerPage = $this->params()->fromQuery('count-per-page', 25);
        
        // get client
        $clientEntity = $this->getClient($clientId);
        
        // set layout up
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->clientId = $clientId;
        
        $this->clientEntity = $clientEntity;
        
        $this->page = $page;
        
        $this->countPerPage = $countPerPage;
    }
}