<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use AccountLedger\Service\LedgerServiceInterface;
use AccountLedger\Form\LedgerForm;
use Zend\View\Model\ViewModel;

/**
 *
 * @author jaimie
 *        
 */
class CreateController extends BaseController
{

    /**
     *
     * @var AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @var ledgerService
     */
    protected $ledgerService;

    /**
     *
     * @var ledgerForm
     */
    protected $ledgerForm;

    /**
     *
     * @param AccountServiceInterface $accountService            
     * @param LedgerServiceInterface $ledgerService            
     * @param LedgerForm $ledgerForm            
     */
    public function __construct(AccountServiceInterface $accountService, LedgerServiceInterface $ledgerService, LedgerForm $ledgerForm)
    {
        $this->accountService = $accountService;
        
        $this->ledgerService = $ledgerService;
        
        $this->ledgerForm = $ledgerForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // account id
        $id = $this->params()->fromRoute('accountId');
        
        $accountEntity = $this->accountService->get($id);
        
        // validate account
        if (! $accountEntity) {
            $this->flashMessenger()->addErrorMessage('The account was not found');
            
            return $this->redirect()->toRoute('account-index');
        }
        
        // request object
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            // set form defaults
            $postData->fromAccountId = $id;
            
            $postData->accountLedgerCreate = time();
            
            $postData->accountLedgerBalance = 0;
            
            $postData->accountLedgerType = 'Transfer';
            
            if (empty($postData->accountLedgerCreditAmount)) {
                $postData->accountLedgerCreditAmount = $postData->accountLedgerDebitAmount;
            }
            
            if (empty($postData->accountLedgerDebitAmount)) {
                $postData->accountLedgerDebitAmount = $postData->accountLedgerCreditAmount;
            }
            
            // set data
            $this->ledgerForm->setData($postData);
            
            // if we are valid
            if ($this->ledgerForm->isValid()) {
                
                $entity = $this->ledgerForm->getData();
                
                $this->accountService->addLedgerCreditItem($entity->getAccountId(), $id, $entity->getAccountLedgerDebitAmount(), $entity->getAccountLedgerMemo());
                
                $this->accountService->addLedgerDebitItem($id, $entity->getAccountId(), $entity->getAccountLedgerDebitAmount(), $entity->getAccountLedgerMemo());
                
                $this->flashMessenger()->addSuccessMessage('The ledger item was saved');
                
                return $this->redirect()->toRoute('account-view', array(
                    'accountId' => $id
                ));
            }
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Account Ledger');
        
        $this->layout()->setVariable('pageSubTitle', 'Create');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-index');
        
        // return form
        return new ViewModel(array(
            'form' => $this->ledgerForm,
            'accountEntity' => $accountEntity
        ));
    }
}
