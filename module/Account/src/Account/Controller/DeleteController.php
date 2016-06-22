<?php
namespace Account\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;

class DeleteController extends BaseController
{
    /**
     * 
     * @var AccountServiceInterface
     */
    protected $accountService;
    
    /**
     * 
     * @param AccountServiceInterface $accountService
     */
    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
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