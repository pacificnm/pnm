<?php
namespace Cron\Controller;

use Application\Controller\BaseController;
use Cron\Service\CronServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var CronServiceInterface
     */
    protected $cronService;
    
    /**
     * 
     * @param CronServiceInterface $cronService
     */
    public function __construct(CronServiceInterface $cronService)
    {
        $this->cronService = $cronService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // trigger event view cron
        $this->getEventManager()->trigger('CronIndex', $this, array(
            'authId' => '',
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        // set from params
        $filter = array(
            'page' => $this->page,
            'count-per-page' => $this->countPerPage,
        );
        
        // get 
        $paginator = $this->cronService->getAll($filter);
        
        $paginator->setCurrentPageNumber($filter['page']);
        
        $paginator->setItemCountPerPage($filter['count-per-page']);
        
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

?>