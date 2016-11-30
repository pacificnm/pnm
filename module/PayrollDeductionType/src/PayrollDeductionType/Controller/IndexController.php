<?php
namespace PayrollDeductionType\Controller;

use Application\Controller\BaseController;
use PayrollDeductionType\Service\PayrollDeductionTypeService;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var PayrollDeductionTypeService
     */
    protected $service;
    
    /**
     * 
     * @param PayrollDeductionTypeService $service
     */
    public function __construct(PayrollDeductionTypeService $service)
    {
        $this->service = $service;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
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
        $this->getEventManager()->trigger('PayrollDeductionTypeIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        // return view
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