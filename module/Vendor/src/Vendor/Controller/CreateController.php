<?php
namespace Vendor\Controller;

use Application\Controller\BaseController;
use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;
use Vendor\Form\VendorForm;
use Account\Service\AccountServiceInterface;
use VendorAccount\Service\AccountServiceInterface as VendorAccountServiceInterface;

use Account\Entity\AccountEntity;

class CreateController extends BaseController
{
    /**
     *
     * @var VendorServiceInterface
     */
    protected $vendorService;
    
    /**
     * 
     * @var AccountServiceInterface
     */
    protected $accountService;
    
    protected $vendorAccountService;
    
    /**
     * 
     * @var VendorForm
     */
    protected $vendorForm;
    
    /**
     * 
     * @param VendorServiceInterface $vendorService
     * @param AccountServiceInterface $accountService
     * @param VendorForm $vendorForm
     */
    public function __construct(VendorServiceInterface $vendorService, AccountServiceInterface $accountService, VendorAccountServiceInterface $vendorAccountService, VendorForm $vendorForm)
    {
        $this->vendorService = $vendorService;
        
        $this->accountService = $accountService;
        
        $this->vendorAccountService = $vendorAccountService;
        
        $this->vendorForm = $vendorForm;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->vendorForm->setData($postData);
        
            // if we are valid
            if ($this->vendorForm->isValid()) {
        
                $entity = $this->vendorForm->getData();
        
                $vendorEntity = $this->vendorService->save($entity);
        
                // create expense account
                $accountEntity = new AccountEntity();
                $accountEntity->setAccountName($vendorEntity->getVendorName());
                $accountEntity->setAccountActive(1);
                $accountEntity->setAccountBalance(0);
                $accountEntity->setAccountCreated(time());
                $accountEntity->setAccountDescription($vendorEntity->getVendorName() . ' expense account');
                $accountEntity->setAccountNumber($vendorEntity->getVendorAccountNumber());
                $accountEntity->setAccountTypeId(13);
                $accountEntity->setAccountVisible(0);
                
                $accountEntity = $this->accountService->save($accountEntity);
                
                // map account
                $vendorAccountEntity = new \VendorAccount\Entity\AccountEntity();
                
                $vendorAccountEntity->setAccountId($accountEntity->getAccountId());
                $vendorAccountEntity->setVendorAccountId(0);
                $vendorAccountEntity->setVendorId($vendorEntity->getVendorId());
                
                $vendorAccountEntity = $this->vendorAccountService->save($vendorAccountEntity);
                
                
                $this->flashmessenger()->addSuccessMessage('The vendor was saved');
        
                return $this->redirect()->toRoute('vendor-view', array(
                    'vendorId' => $vendorEntity->getVendorId()
                ));
            }
        }
        
        // set form defaults
        $this->vendorForm->get('vendorId')->setValue(0);
        
        $this->vendorForm->get('vendorActive')->setValue(1);
    
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendors');
    
        $this->layout()->setVariable('pageSubTitle', 'Create');
    
        $this->layout()->setVariable('activeMenuItem', 'account');
    
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
    
    
        return new ViewModel(array(
            'form' => $this->vendorForm
        ));
    }
}