<?php
namespace EstimateOptionItem\Controller;

use Application\Controller\BaseController;
use Estimate\Service\EstimateServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use EstimateOptionItem\Service\ItemServiceInterface;
use Zend\View\Model\ViewModel;
use EstimateOptionItem\Form\ItemForm;
use Client\Service\ClientServiceInterface;

class CreateController extends BaseController
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
        
        if (! $optionEntity) {
            $this->flashMessenger()->addErrorMessage('can not find the estimate option');
            
            return $this->redirect()->toRoute('estimate-index', array(
                'clientId' => $id
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->itemForm->setData($postData);
            
            if ($this->itemForm->isValid()) {
                
                $entity = $this->itemForm->getData();
                
                // save the estimate
                $itemEntity = $this->itemService->save($entity);
                
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Created Estimate Option Item' . $itemEntity->getEstimateOptionItemId());
                
                $this->flashMessenger()->addSuccessMessage('The estimate option item was saved');
                
                // return to view estimate
                return $this->redirect()->toRoute('estimate-view', array(
                    'clientId' => $id,
                    'estimateId' => $estimateId
                ));
            }
        }
        
        // set up form
        $this->itemForm->get('estimateOptionItemId')->setValue(0);
        
        $this->itemForm->get('estimateOptionId')->setValue($estimateOptionId);
        
        $this->itemForm->get('estimateOptionItemTotal')->setValue(0);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Create Estimate Option Item');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        return new ViewModel(array(
            'form' => $this->itemForm
        ));
    }
}