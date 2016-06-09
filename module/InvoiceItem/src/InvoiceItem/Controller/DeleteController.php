<?php
namespace InvoiceItem\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
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
     * @param ClientServiceInterface $clientService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param ItemServiceInterface $itemService            
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
    }

    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $invoiceId = $this->params()->fromRoute('invoiceId');
        
        $invoiceItemId = $this->params()->fromRoute('invoiceItemId');
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        // get invoice
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
            
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $clientId
            ));
        }
        
        // get item
        $itemEntity = $this->itemService->get($invoiceItemId);
        
        if (! $itemEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice item was not found.');
            
            return $this->redirect()->toRoute('invoice-view', array(
                'clientId' => $clientId,
                'invoiceId' => $invoiceId
            ));
        }
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $this->itemService->delete($itemEntity);
                
                $itemEntitys = $this->itemService->getAll(array(
                    'invoiceId' => $invoiceId
                ));
                
                $newTotal = 0;
                
                foreach ($itemEntitys as $itemEntity) {
                    $newTotal = $newTotal + $itemEntity->getInvoiceItemTotal();
                }
                
                
                
                $invoiceEntity->setInvoiceBalance($newTotal);
                $invoiceEntity->setInvoiceSubtotal($newTotal);
                $invoiceEntity->setInvoiceTotal($newTotal);
                
                $this->invoiceService->save($invoiceEntity);
                
                $this->flashmessenger()->addSuccessMessage('The invoice item was deleted');
            }
            
            return $this->redirect()->toRoute('invoice-view', array(
                'clientId' => $clientId,
                'invoiceId' => $invoiceId
            ));
        }
        
        // set up layout
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Delete Invoice Item');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'invoice-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'itemEntity' => $itemEntity
        ));
    }
}