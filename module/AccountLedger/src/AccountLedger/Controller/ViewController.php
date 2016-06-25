<?php
namespace AccountLedger\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use AccountLedger\Service\LedgerServiceInterface;
use Zend\View\Model\ViewModel;

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
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('accountId');
        
        $accountLedgerId = $this->params()->fromRoute('accountLedgerId');
        
        $accountEntity = $this->accountService->get($id);
        
        $ledgerEntity = $this->ledgerService->get($accountLedgerId);
        
        // validate account
        if (! $accountEntity) {
            $this->flashMessenger()->addErrorMessage('The account was not found');
            
            return $this->redirect()->toRoute('account-index');
        }
        
        // validate ledger
        if (! $ledgerEntity) {
            $this->flashMessenger()->addErrorMessage('The account ledger was not found');
            
            return $this->redirect()->toRoute('account-view', array(
                'accountId' => $id
            ));
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Account Ledger');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-index');
        
        return new ViewModel(array(
            'accountEntity' => $accountEntity,
            'ledgerEntity' => $ledgerEntity
        ));
    }
}