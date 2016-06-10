<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use InvoiceOption\Service\OptionServiceInterface;
use InvoiceItem\Form\ItemForm;
use InvoicePayment\Form\PaymentForm;
use Location\Service\LocationServiceInterface;
use Phone\Service\PhoneServiceInterface;
use InvoicePayment\Service\PaymentServiceInterface;
use Workorder\Service\WorkorderServiceInterface;

class ViewController extends BaseController
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
     * @var PaymentServiceInterface
     */
    protected $paymentService;

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

    protected $workorderService;
    
    /**
     *
     * @var ItemForm
     */
    protected $itemForm;

    /**
     *
     * @var PaymentForm
     */
    protected $paymentForm;

    
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, OptionServiceInterface $optionService, PaymentServiceInterface $paymentService, LocationServiceInterface $locationService, PhoneServiceInterface $phoneService, WorkorderServiceInterface $workorderService, ItemForm $itemForm, PaymentForm $paymentForm)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->optionService = $optionService;
        
        $this->paymentService = $paymentService;
        
        $this->locationService = $locationService;
        
        $this->phoneService = $phoneService;
        
        $this->workorderService = $workorderService;
        
        $this->itemForm = $itemForm;
        
        $this->paymentForm = $paymentForm;
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
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' invoice #' . $invoiceId);
        
        // get items
        $itemEntitys = $this->itemService->getAll(array(
            'invoiceId' => $invoiceId
        ));
        
        // get invoice options
        $optionEntity = $this->optionService->get(1);
        
        // get payments
        $paymentEntitys = $this->paymentService->getInvoicePayments($invoiceId);
        
        // get billing location
        $locationEntity = $this->locationService->getClientBillingLocation($id);
        
        // get location phone
        $phoneEntity = $this->phoneService->getPrimaryPhoneByLocation($locationEntity->getLocationId());
        
        // get workorders
        $workorderEntitys = $this->workorderService->getInvoiceWorkorders($invoiceId);
        
        // item form
        $this->itemForm->get('invoiceItemId')->setValue(0);
        
        $this->itemForm->get('invoiceId')->setValue($invoiceId);
        
        $this->itemForm->get('invoiceItemDate')->setValue(time());
        
        $this->itemForm->get('invoiceItemTotal')->setValue(0);
        
        $this->itemForm->setAttribute('action', $this->url()
            ->fromRoute('invoice-item-create', array(
            'clientId' => $id,
            'invoiceId' => $invoiceId
        )));
        
        // payment form
        $this->paymentForm->get('invoicePaymentId')->setValue(0);
        
        $this->paymentForm->get('invoiceId')->setValue($invoiceId);
        
        $this->paymentForm->get('invoicePaymentDate')->setValue(date("m/d/Y"));
        
        $this->paymentForm->get('invoicePaymentAmount')->setValue($invoiceEntity->getInvoiceTotal());
        
        $this->paymentForm->setAttribute('action', $this->url()
            ->fromRoute('invoice-payment-create', array(
            'clientId' => $id,
            'invoiceId' => $invoiceId
        )));
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Invoice');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'invoice-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'invoiceEntity' => $invoiceEntity,
            'itemEntitys' => $itemEntitys,
            'paymentEntitys' => $paymentEntitys,
            'optionEntity' => $optionEntity,
            'locationEntity' => $locationEntity,
            'phoneEntity' => $phoneEntity,
            'workorderEntitys' => $workorderEntitys,
            'itemForm' => $this->itemForm,
            'paymentForm' => $this->paymentForm
        ));
    }
}