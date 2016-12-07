<?php
namespace ReportProfit\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use ReportProfit\Service\ReportProfitServiceInterface;

class IndexController extends BaseController
{

    /**
     *
     * @var ReportProfitServiceInterface
     */
    protected $service;

    /**
     *
     * @param ReportProfitServiceInterface $service            
     */
    public function __construct(ReportProfitServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Application\Controller\BaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $year = $this->params()->fromQuery('year', date("Y", time()));
        
        $entitys = $this->service->getYear($year);
        
        // trigger event view cron
        $this->getEventManager()->trigger('ReportProfitIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        // return view
        return new ViewModel(array(
            'year' => $year,
            'entitys' => $entitys
        ));
    }
}

