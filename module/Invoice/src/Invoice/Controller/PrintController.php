<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use InvoiceOption\Service\OptionServiceInterface;
use Location\Service\LocationServiceInterface;
use Phone\Service\PhoneServiceInterface;
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
     * @var OptionServiceInterface
     */
    protected $optionService;

    /**
     *
     * @var LocationServiceInterface
     */
    protected $locationService;

    /**
     *
     * @var PhoneServiceInterface
     */
    protected $phoneService;

    /**
     * 
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param InvoiceServiceInterface $invoiceService
     * @param ItemServiceInterface $itemService
     * @param OptionServiceInterface $optionService
     * @param LocationServiceInterface $locationService
     * @param PhoneServiceInterface $phoneService
     * @param WorkorderServiceInterface $workorderService
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, OptionServiceInterface $optionService, LocationServiceInterface $locationService, PhoneServiceInterface $phoneService, WorkorderServiceInterface $workorderService)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->optionService = $optionService;
        
        $this->locationService = $locationService;
        
        $this->phoneService = $phoneService;
        
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
        
        $invoiceId = $this->params()->fromRoute('invoiceId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
            
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $id
            ));
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'Print Client ' . $clientEntity->getClientName() . ' invoice #' . $invoiceId);
        
        // get items
        $itemEntitys = $this->itemService->getAll(array(
            'invoiceId' => $invoiceId
        ));
        
        // get invoice options
        $optionEntity = $this->optionService->get(1);
        
        // get billing location
        $locationEntity = $this->locationService->getClientBillingLocation($id);
        
        // get location phone
        $phoneEntity = $this->phoneService->getPrimaryPhoneByLocation($locationEntity->getLocationId());
        
        // get work orders
        $workorderEntitys = $this->workorderService->getInvoiceWorkorders($invoiceId);
        
        $this->layout('/layout/print.phtml');
        
        $this->setHeadTitle('Invoice ' . $invoiceId);
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'invoiceEntity' => $invoiceEntity,
            'itemEntitys' => $itemEntitys,
            'optionEntity' => $optionEntity,
            'locationEntity' => $locationEntity,
            'phoneEntity' => $phoneEntity,
            'workorderEntitys' => $workorderEntitys
        ));
    }
}