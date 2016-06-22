<?php
namespace Account\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use Account\Form\AccountForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
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
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
        
        $this->accountForm->get('accountId')->setValue(0);
        
        $this->accountForm->get('accountCreated')->setValue(time());
        
        $this->accountForm->get('accountActive')->setValue(1);
        
        $this->accountForm->get('accountBalance')->setValue(0);
        
        $this->accountForm->get('accountVisible')->setValue(1);
        
        $this->layout()->setVariable('pageTitle', 'Accounts');
        
        $this->layout()->setVariable('pageSubTitle', 'New');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-index');
        
        return new ViewModel(array(
            'form' => $this->accountForm
        ));
    }
}
