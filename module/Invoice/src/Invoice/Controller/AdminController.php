<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Invoice\Service\InvoiceServiceInterface;
use Zend\View\Model\ViewModel;

class AdminController extends BaseController
{
    /**
     * 
     * @var InvoiceServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @param InvoiceServiceInterface $service
     */
    public function __construct(InvoiceServiceInterface $service)
    {
        $this->service = $service;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $filter = array(
            'invoiceStatus' => $this->params()->fromQuery('invoiceStatus')
        );
        
        // get paginator
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($this->page);
        
        $paginator->setItemCountPerPage($this->countPerPage);
        
        // trigger event
        $this->getEventManager()->trigger('invoiceAdminIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        return new ViewModel(array(
            'paginator' => $paginator,
            'page' => $this->page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array()
        ));
    }
}

