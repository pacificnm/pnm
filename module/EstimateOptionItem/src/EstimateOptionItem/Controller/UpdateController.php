<?php
namespace EstimateOptionItem\Controller;

use Application\Controller\BaseController;
use Estimate\Service\EstimateServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use EstimateOptionItem\Service\ItemServiceInterface;
use Zend\View\Model\ViewModel;
use EstimateOptionItem\Form\ItemForm;
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
     * @var ItemForm
     */
    protected $itemForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param EstimateServiceInterface $estimateService
     * @param OptionServiceInterface $optionService
     * @param ItemServiceInterface $itemService
     * @param ItemForm $itemForm
     */
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService, OptionServiceInterface $optionService, ItemServiceInterface $itemService, ItemForm $itemForm)
    {
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;
    
        $this->optionService = $optionService;
    
        $this->itemService = $itemService;
        
        $this->itemForm = $itemForm;
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
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->itemForm->setData($postData);
        
            // if form is valid
            if ($this->itemForm->isValid()) {
        
                $entity = $this->itemForm->getData();
        
                $entity->setEstimateOptionItemTotal($entity->getEstimateOptionItemQty() * $entity->getEstimateOptionItemAmount());
        
                // save the estimate
                $itemEntity = $this->itemService->save($entity);
        
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'UPDATE', $this->identity()
                    ->getAuthId(), 'Updated Estimate Option Item' . $itemEntity->getEstimateOptionItemId());
        
                $this->flashMessenger()->addSuccessMessage('The estimate option item was saved');
        
                // return to view estimate
                return $this->redirect()->toRoute('estimate-view', array(
                    'clientId' => $id,
                    'estimateId' => $estimateId
                ));
            }
        }
        
        
        // bind form
        $this->itemForm->bind($itemEntity);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Edit Estimate Item');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        // return view model
        return new ViewModel(array(
            'form' => $this->itemForm
        ));
    }
}