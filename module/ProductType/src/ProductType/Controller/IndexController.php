<?php
namespace ProductType\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use ProductType\Service\ProductTypeServiceInterface;

class IndexController extends BaseController
{

    /**
     *
     * @var ProductTypeServiceInterface
     */
    protected $service;

    /**
     *
     * @param ProductTypeServiceInterface $service            
     */
    public function __construct(ProductTypeServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // trigger event
        $this->getEventManager()->trigger('ProductTypeIndex', $this, array(
            'authId' => $this->identity()
                ->getAuthId(),
            'historyUrl' => $this->getRequest()
                ->getUri()
        ));
        
        // set from params
        $filter = array(
            'page' => $this->page,
            'count-per-page' => $this->countPerPage
        );
        
        // get
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($filter['page']);
        
        $paginator->setItemCountPerPage($filter['count-per-page']);
        
        // return view model
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

