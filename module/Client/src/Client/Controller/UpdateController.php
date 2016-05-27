<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Client\Service\ClientServiceInterface;
class UpdateController extends BaseController
{
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     */
    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {}
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Client');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel();
    }
}