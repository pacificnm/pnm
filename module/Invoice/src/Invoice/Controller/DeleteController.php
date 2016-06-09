<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use InvoicePayment\Service\PaymentServiceInterface;

class DeleteController extends BaseController
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
     * @var PaymentServiceInterface
     */
    protected $paymentService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param ItemServiceInterface $itemService            
     * @param PaymentServiceInterface $paymentService            
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, PaymentServiceInterface $paymentService)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->paymentService = $paymentService;
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
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                // delete items
                $itemEntitys = $this->itemService->getAll(array(
                    'invoiceId' => $invoiceId
                ));
                
                foreach($itemEntitys as $itemEntity) {
                    $this->itemService->delete($itemEntity);
                }
                
                // delete payments
                $paymentEntitys = $this->paymentService->getInvoicePayments($invoiceId);
                
                foreach($paymentEntitys as $paymentEntity) {
                    $this->paymentService->delete($paymentEntity);
                }
                
                // delete invoice
                $this->invoiceService->delete($invoiceEntity);
                
                $this->flashmessenger()->addSuccessMessage('The invoice was deleted');
                
                return $this->redirect()->toRoute('invoice-list', array(
                    'clientId' => $id
                ));
            }
            
            return $this->redirect()->toRoute('invoice-view', array(
                'clientId' => $id,
                'invoiceId' => $invoiceId
            ));
        }
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Invoice');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'invoiceEntity' => $invoiceEntity
        ));
    }
}