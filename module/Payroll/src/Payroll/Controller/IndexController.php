<?php
namespace Payroll\Controller;

use Application\Controller\BaseController;
use Payroll\Service\PayrollServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var PayrollServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @param PayrollServiceInterface $service
     */
    public function __construct(PayrollServiceInterface $service)
    {
        $this->service = $service;
    }
    
    public function indexAction()
    {
        // set from params
        $filter = array(
            'page' => $this->page,
            'count-per-page' => $this->countPerPage,
        );
        
        // get all
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($filter['page']);
        
        $paginator->setItemCountPerPage($filter['count-per-page']);
        
        // trigger event view cron
        $this->getEventManager()->trigger('PayrollIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        return new ViewModel(array(
            'paginator' => $paginator,
            'page' => $filter['page'],
            'count-per-page' => $filter['count-per-page'],
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array()
        ));
    }
}