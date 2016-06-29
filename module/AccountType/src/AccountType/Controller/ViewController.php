<?php
namespace AccountType\Controller;

use Application\Controller\BaseController;
use AccountType\Service\TypeServiceInterface;
use Zend\View\Model\ViewModel;
use Account\Service\AccountServiceInterface;

class ViewController extends BaseController
{

    /**
     *
     * @var TypeServiceInterface
     */
    protected $typeService;

    /**
     *
     * @var AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @param TypeServiceInterface $typeService            
     * @param AccountServiceInterface $accountService            
     */
    public function __construct(TypeServiceInterface $typeService, AccountServiceInterface $accountService)
    {
        $this->typeService = $typeService;
        
        $this->accountService = $accountService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // account type id
        $id = $this->params()->fromRoute('accountTypeId');
        
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        // get type entity
        $typeEntity = $this->typeService->get($id);
        
        // verify account type
        if (! $typeEntity) {
            $this->flashMessenger()->addErrorMessage('The Account type could not be found');
            
            return $this->redirect()->toRoute('account-view');
        }
        
        // accounts under this type
        $paginator = $this->accountService->getAccountsByType($id);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
       
        
        // Set layout vars
        $this->layout()->setVariable('pageTitle', 'Account Types');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-type-index');
        
        // return view
        return new ViewModel(array(
            'typeEntity' => $typeEntity,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array()
        ));
    }
}