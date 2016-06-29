<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use Account\Form\AccountForm;
use Zend\View\Model\ViewModel;

/**
 *
 * @author jaimie
 *
 */
class UpdateController extends BaseController
{

    /**
     *
     * @var AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @var AccountForm
     */
    protected $accountForm;

    /**
     *
     * @param AccountServiceInterface $accountService            
     * @param AccountForm $accountForm            
     */
    public function __construct(AccountServiceInterface $accountService, AccountForm $accountForm)
    {
        $this->accountService = $accountService;
        
        $this->accountForm = $accountForm;
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
        
        // get account entity
        $accountEntity = $this->accountService->get($id);
        
        // validate we got one
        if (! $accountEntity) {
            $this->flashMessenger()->addErrorMessage('The account was not found');
            
            return $this->redirect()->toRoute('account-index');
        }
        
        // request object
        $request = $this->getRequest();
        
        // bind object to form
        $this->accountForm->bind($accountEntity);
        
        // disable fields
        $this->accountForm->get('accountTypeId')->setAttribute('disabled', true);
        
        $this->accountForm->get('accountBalance')->setAttribute('disabled', true);
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            // we have to do this because we disabled the fields above else it fails validation
            $postData->accountTypeId = $accountEntity->getAccountTypeId();
           
            $postData->accountBalance = $accountEntity->getAccountBalance();
            
            $this->accountForm->setData($postData);
            // if we are valid
            if ($this->accountForm->isValid()) {
                
                $entity = $this->accountForm->getData();
                
                $accountEntity = $this->accountService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The account was saved');
                
                return $this->redirect()->toRoute('account-view', array(
                    'accountId' => $accountEntity->getAccountId()
                ));
            }
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Accounts');
        
        $this->layout()->setVariable('pageSubTitle', 'Edit');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-index');
        
        return new ViewModel(array(
            'form' => $this->accountForm
        ));
    }
}