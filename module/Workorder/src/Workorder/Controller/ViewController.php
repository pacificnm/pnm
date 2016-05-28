<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
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
    
        $this->layout()->setVariable('pageTitle', 'View Work Order');
    
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
    
        $this->setHeadTitle($clientEntity->getClientName());
    
        $this->layout()->setVariable('activeMenuItem', 'client');
    
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id
        ));
    }
}

?>