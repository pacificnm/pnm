<?php
namespace WorkorderTime\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderTime\Service\TimeServiceInterface;


class SalesByLabor extends AbstractHelper
{

    /**
     * 
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     * 
     * @param TimeServiceInterface $timeService
     */
    public function __construct(TimeServiceInterface $timeService)
    {
        
        $this->timeService = $timeService;
    }

    public function __invoke($clientId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $timeEntitys = $this->timeService->getTotalByLabor($clientId);

        $total = 0;
        
        foreach($timeEntitys as $entity) {
            $total = $total + $entity->workorder_labor_total;
        }
        
        $data = new \stdClass();
        
        $data->timeEntitys = $timeEntitys;
        
        $data->total = $total;
        
        return $partialHelper('partials/sales-by-labor.phtml', $data);
    }
}
