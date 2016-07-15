<?php
namespace EstimateOption\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Estimate\Service\EstimateServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use Zend\View\Model\ViewModel;
use EstimateOptionItem\Service\ItemServiceInterface;

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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $estimateId = $this->params()->fromRoute('estimateId');
        
        $estimateOptionId = $this->params()->fromRoute('estimateOptionId');
        
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
        
        // validate we got an estimate
        if (! $estimateEntity) {
            $this->flashMessenger()->addErrorMessage('can not find estimate');
        
            return $this->redirect()->toRoute('estimate-index', array(
                'clientId' => $id
            ));
        }
        
        // get option entity
        $optionEntity = $this->optionService->get($estimateOptionId);
        
        if(! $optionEntity) {
            $this->flashMessenger()->addErrorMessage('can not find estimate');
            
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
                    ->getAuthId(), 'Deleted Estimate Option' . $optionEntity->getEstimateOptionId());
        
                // remove items
                $this->itemService->deleteOptionItems($estimateOptionId);
                
                $this->optionService->delete($optionEntity);
                
                $this->flashMessenger()->addSuccessMessage('The estimate option was deleted');
            }
        
            return $this->redirect()->toRoute('estimate-view', array('clientId' => $id, 'estimateId' => $estimateId));
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Delete Estimate Option');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        return new ViewModel(array(
           'optionEntity' => $optionEntity 
        ));
    }
}
