<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;

class DeleteController extends BaseController
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
        
        // get client entity
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find client');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        // validate we got a work order
        if (! $workorderEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find work order');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        // request
        $request = $this->getRequest();
        
        // if post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $workorderEntity->setWorkorderStatus('Deleted');
                
                $this->workorderService->save($workorderEntity);
                
                $this->flashmessenger()->addSuccessMessage('The work order was deleted');
                
                return $this->redirect()->toRoute('workorder-list', array(
                    'clientId' => $id
                ));
            }
            
            // return to view
            return $this->redirect()->toRoute('client-view', array(
                'clientId' => $id
            ));
        }
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderEntity' => $workorderEntity
        ));
    }
}