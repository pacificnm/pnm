<?php
namespace Account\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use Account\Form\AccountForm;

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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        
    }
}