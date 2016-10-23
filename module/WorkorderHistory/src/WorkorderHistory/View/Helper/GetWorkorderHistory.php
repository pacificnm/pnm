<?php
namespace WorkorderHistory\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderHistory\Service\WorkorderHistoryServiceInterface;
class GetWorkorderHistory extends AbstractHelper
{
    /**
     * 
     * @var WorkorderHistoryServiceInterface
     */
    protected $workorderHsitoryService;
    
    /**
     * 
     * @param unknown $workorderId
     */
    public function __invoke($workorderId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data  = new \stdClass();
        
        $workorderHistoryEntitys = $this->workorderHsitoryService->getWorkorderHistory($workorderId);
        
        $data->workorderHistoryEntitys = $workorderHistoryEntitys;

        return $partialHelper('partials/get-workorder-history.phtml', $data);
    }
    
    /**
     * 
     * @param WorkorderHistoryServiceInterface $workorderHsitoryService
     */
    public function __construct(WorkorderHistoryServiceInterface $workorderHsitoryService)
    {
        
        $this->workorderHsitoryService = $workorderHsitoryService;
    }
}

?>