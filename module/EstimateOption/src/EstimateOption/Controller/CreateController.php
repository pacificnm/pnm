<?php
namespace EstimateOption\Controller;

use Application\Controller\BaseController;
use EstimateOption\Service\OptionServiceInterface;
use EstimateOption\Form\OptionForm;
use Client\Service\ClientServiceInterface;
use Estimate\Service\EstimateServiceInterface;
use Zend\View\Model\ViewModel;

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
     * @var OptionForm
     */
    protected $optionForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param EstimateServiceInterface $estimateService            
     * @param OptionServiceInterface $optionService            
     * @param OptionForm $optionForm            
     */
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService, OptionServiceInterface $optionService, OptionForm $optionForm)
    {
    
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;
        
        $this->optionService = $optionService;
        
        $this->optionForm = $optionForm;
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
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->optionForm->setData($postData);
            
            if ($this->optionForm->isValid()) {
                
                $entity = $this->optionForm->getData();
                
                // save the estimate
                $optionEntity = $this->optionService->save($entity);
                
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Created Estimate Option' . $optionEntity->getEstimateOptionId());
                
                $this->flashMessenger()->addSuccessMessage('The estimate option was saved');
                
                // return to view estimate
                return $this->redirect()->toRoute('estimate-view', array(
                    'clientId' => $id,
                    'estimateId' => $estimateId
                ));
            }
        }
        
        // set form values
        $this->optionForm->get('estimateOptionId')->setValue(0);
        
        $this->optionForm->get('estimateId')->setValue($estimateId);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Estimate Options');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        // return view
        return new ViewModel(array(
            'form' => $this->optionForm,
        ));
    }
}
