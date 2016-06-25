<?php
namespace Account\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use Zend\View\Model\ViewModel;
use AccountLedger\Service\LedgerServiceInterface;

class ViewController extends BaseController
{
    /**
     * 
     * @var AccountServiceInterface
     */
    protected $accountService;
    
    /**
     * 
     * @var LedgerServiceInterface
     */
    protected $ledgerService;
    
    /**
     * 
     * @param AccountServiceInterface $accountService
     * @param LedgerServiceInterface $ledgerService
     */
    public function __construct(AccountServiceInterface $accountService, LedgerServiceInterface $ledgerService)
    {
        $this->accountService = $accountService;
        
        $this->ledgerService = $ledgerService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('accountId');
        
        // page
        $page = $this->params()->fromQuery('page', 0);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        
        $accountEntity = $this->accountService->get($id);
        
        if(! $accountEntity) {
            $this->flashMessenger()->addErrorMessage('The account was not found');
            
            return $this->redirect()->toRoute('account-index');
        }
        
        // get ledger items
        $paginator = $this->ledgerService->getAll(array('accountId' => $id));
        
        if($page == 0) {
            $paginator->setCurrentPageNumber($paginator->count());
            $page = $paginator->count();
        } else {
            $paginator->setCurrentPageNumber($page);
        }
       
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Accounts');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-index');
        
        
        return new ViewModel(array(
            'accountEntity' => $accountEntity,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(
                'accountId' => $id
            ),
        ));
    }
}