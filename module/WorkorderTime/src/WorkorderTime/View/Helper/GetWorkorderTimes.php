<?php
namespace WorkorderTime\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Workorder\Entity\WorkorderEntity;
use WorkorderTime\Service\TimeServiceInterface;

class GetWorkorderTimes extends AbstractHelper
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

    /**
     *
     * @param WorkorderEntity $workorderEntity            
     * @param string $displayLinks            
     */
    public function __invoke(WorkorderEntity $workorderEntity, $displayLinks = true)
    {        
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $timeEntitys = $this->timeService->getWorkorderTimes($workorderEntity->getWorkorderId());
        
        $data->timeEntitys = $timeEntitys;
        
        $data->workorderEntity = $workorderEntity;
        
        $data->displayLinks = $displayLinks;
        
        return $partialHelper('partials/get-workorder-times.phtml', $data);
    }
}