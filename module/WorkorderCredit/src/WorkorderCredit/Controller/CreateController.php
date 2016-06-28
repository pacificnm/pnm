<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderCredit\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderCredit\Service\CreditServiceInterface;
use WorkorderCredit\Form\CreditForm;
use Account\Service\AccountServiceInterface;
use ClientAccount\Service\AccountServiceInterface as ClientAccountServiceInterface;
use AccountLedger\Service\LedgerServiceInterface;

/**
 * Create Credit Controller
 *
 * @author jaimie (pacificnm@gmail.com)
 *        
 */
class CreateController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @var CreditServiceInterface
     */
    protected $creditService;

    /**
     *
     * @var AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @var ClientAccountServiceInterface
     */
    protected $clientAccountService;

    /**
     *
     * @var LedgerServiceInterface
     */
    protected $ledgerService;

    /**
     *
     * @var CreditForm
     */
    protected $creditForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param CreditServiceInterface $creditService            
     * @param AccountServiceInterface $accountService            
     * @param ClientAccountServiceInterface $clientAccountService            
     * @param LedgerServiceInterface $ledgerService            
     * @param CreditForm $creditForm            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, CreditServiceInterface $creditService, AccountServiceInterface $accountService, ClientAccountServiceInterface $clientAccountService, LedgerServiceInterface $ledgerService, CreditForm $creditForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->creditService = $creditService;
        
        $this->accountService = $accountService;
        
        $this->clientAccountService = $clientAccountService;
        
        $this->ledgerService = $ledgerService;
        
        $this->creditForm = $creditForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        // get client
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find client');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // get client account
        $clientAccountEntity = $this->clientAccountService->getClientAccount($clientEntity->getClientId());
        
        if (! $clientAccountEntity) {
            $this->flashMessenger()->addErrorMessage('Client is missing an account to recieve payments');
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            ));
        }
        
        // get workorder
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashMessenger()->addErrorMessage('can not find work order');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $clientId
            ));
        }
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            $postData = $request->getPost();
            
            $this->creditForm->setData($postData);
            
            // if form is valid
            if ($this->creditForm->isValid()) {
                
                $entity = $this->creditForm->getData();
                
                
                
                // get account we are depositing credit to
                $accountEntity = $this->accountService->get($postData->accountId);
                
                if (! $accountEntity) {
                    $this->flashMessenger()->addErrorMessage('cannot find payment account');
                    
                    return $this->redirect()->toRoute('workorder-view', array(
                        'clientId' => $clientId,
                        'workorderId' => $workorderId
                    ));
                }
                
                // set ledger memo
                $ledgerMemo = $clientEntity->getClientName() . ' credit payment for work order #' . $workorderId;
                
                // add credit to account service
                try {
                    $ledgerEntity = $this->accountService->addLedgerCreditItem($accountEntity->getAccountId(), $clientAccountEntity->getAccountId(), $entity->getWorkorderCreditAmount(), $ledgerMemo);
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage('Could not save credit to account: ' . $e->getMessage());
                    
                    return $this->redirect()->toRoute('workorder-view', array(
                        'clientId' => $clientId,
                        'workorderId' => $workorderId
                    ));
                }
                
                // debit client account
                try {
                    $this->accountService->addLedgerDebitItem($clientAccountEntity->getAccountId(), $accountEntity->getAccountId(), $entity->getWorkorderCreditAmount(), $ledgerMemo);
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage('Could not save credit to client account: ' . $e->getMessage());
                    
                    return $this->redirect()->toRoute('workorder-view', array(
                        'clientId' => $clientId,
                        'workorderId' => $workorderId
                    ));
                }
                
                // set credit amount left
                $entity->setWorkorderCreditAmountLeft($entity->getWorkorderCreditAmount());
                
                // set accountId
                $entity->setAccountId($ledgerEntity->getAccountId());
                
                // set accountLedgerId
                $entity->setAccountLedgerId($ledgerEntity->getAccountLedgerId());
                
                // save credit
                try {
                    $this->creditService->save($entity);
                } catch(\Exception $e) {
                    $this->flashMessenger()->addErrorMessage('Could not save credit: ' . $e->getMessage());
                    
                    return $this->redirect()->toRoute('workorder-view', array(
                        'clientId' => $clientId,
                        'workorderId' => $workorderId
                    ));
                }
                
                // set message
                $this->flashmessenger()->addSuccessMessage('The work order credit was saved.');
                
                // return to work order
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderId
                ));
            }
            
            // @todo collect error and pass back to work order
        }
        
        // not saved set message
        $this->flashmessenger()->addErrorMessage('The work order credit was NOT saved.');
        
        // return to work order
        return $this->redirect()->toRoute('workorder-view', array(
            'clientId' => $clientId,
            'workorderId' => $workorderId
        ));
    }
}