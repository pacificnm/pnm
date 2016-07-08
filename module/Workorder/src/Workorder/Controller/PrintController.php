<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;

class PrintController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     * 
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' print work order #' . $workorderId);
        
        $this->setHeadTitle('Work Order ' . $workorderId);
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $this->layout('/layout/print.phtml');
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderEntity' => $workorderEntity
        ));
    }
}

?>