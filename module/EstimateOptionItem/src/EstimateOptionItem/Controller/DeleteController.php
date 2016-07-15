<?php
namespace EstimateOptionItem\Controller;

use Application\Controller\BaseController;
use Estimate\Service\EstimateServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use EstimateOptionItem\Service\ItemServiceInterface;
use Zend\View\Model\ViewModel;
use Client\Service\ClientServiceInterface;

class DeleteController extends BaseController
{
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     *
     * @var EstimateServiceInterface
     */
    protected $estimateService;
    
    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;
    
    /**
     *
     * @var ItemServiceInterface
     */
    protected $itemService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param EstimateServiceInterface $estimateService
     * @param OptionServiceInterface $optionService
     * @param ItemServiceInterface $itemService
     */
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService, OptionServiceInterface $optionService, ItemServiceInterface $itemService)
    {
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;
    
        $this->optionService = $optionService;
    
        $this->itemService = $itemService;
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
        
        $estimateId = $this->params()->fromRoute('estimateId');
        
        $estimateOptionId = $this->params()->fromRoute('estimateOptionId');
        
        $estimateOptionItemId = $this->params()->fromRoute('estimateOptionItemId');
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        // get estimate
        $estimateEntity = $this->estimateService->get($estimateId);
        
        if(! $estimateEntity) {
            $this->flashmessenger()->addErrorMessage('Estimate was not found.');
        
            return $this->redirect()->toRoute('estimate-index', array('clientId' => $id));
        }
        
        // get option entity
        $optionEntity = $this->optionService->get($estimateOptionId);
        
        if (! $optionEntity) {
            $this->flashMessenger()->addErrorMessage('can not find the estimate option');
        
            return $this->redirect()->toRoute('estimate-index', array(
                'clientId' => $id
            ));
        }
        
        // get item
        $itemEntity = $this->itemService->get($estimateOptionItemId);
        
        if(! $itemEntity) {
            $this->flashMessenger()->addErrorMessage('can not find the estimate option item');
        
            return $this->redirect()->toRoute('estimate-index', array(
                'clientId' => $id
            ));
        }
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'DELETE', $this->identity()
                    ->getAuthId(), 'Deleted Estimate Option Item' . $itemEntity->getEstimateOptionItemId());
                
                $this->itemService->delete($itemEntity);
                
                $this->flashMessenger()->addSuccessMessage('The estimate item was deleted');
            }
            
            return $this->redirect()->toRoute('estimate-view', array('clientId' => $id, 'estimateId' => $estimateId));
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Delete Estimate Item');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
    
        return new ViewModel(array(
            'itemEntity' => $itemEntity
        ));
    }
}
