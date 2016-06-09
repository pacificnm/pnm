<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderPart\Service\PartServiceInterface;
use WorkorderTime\Service\TimeServiceInterface;

class WorkorderController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var InvoiceServiceInterface
     */
    protected $invoiceService;

    /**
     *
     * @var ItemServiceInterface
     */
    protected $itemService;

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;

    /**
     *
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param ItemServiceInterface $itemService            
     * @param WorkorderServiceInterface $workorderService            
     * @param PartServiceInterface $partService            
     * @param TimeServiceInterface $timeService            
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, WorkorderServiceInterface $workorderService, PartServiceInterface $partService, TimeServiceInterface $timeService)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->workorderService = $workorderService;
        
        $this->itemService = $itemService;
        
        $this->partService = $partService;
        
        $this->timeService = $timeService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $invoiceId = $this->params()->fromRoute('invoiceId');
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-list');
        }
        
        // get invoice
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
        
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $id
            ));
        }
        
        
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Add Work Order To Invoice');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'invoice-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
    }
}