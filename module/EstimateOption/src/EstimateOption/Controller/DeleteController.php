<?php
namespace EstimateOption\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Estimate\Service\EstimateServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use Zend\View\Model\ViewModel;

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
     * @param ClientServiceInterface $clientService
     * @param EstimateServiceInterface $estimateService
     * @param OptionServiceInterface $optionService
     */
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService, OptionServiceInterface $optionService)
    {
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;
        
        $this->optionService = $optionService;
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
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Estimate Options');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        return new ViewModel(array());
    }
}

?>