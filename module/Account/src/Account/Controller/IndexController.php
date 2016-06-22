<?php
namespace Account\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
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
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        $accountVisible = $this->params()->fromQuery('account-visible', 1);
        
        $filter = array(
            'accountVisible' => $accountVisible
        );
        
        $paginator = $this->accountService->getAll($filter);

        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Accounts');
        
        $this->layout()->setVariable('pageSubTitle', 'List');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        // return view
        return new ViewModel(array(
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(),
        ));
    }
}
