<?php
namespace WorkorderCredit\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderCredit\Service\CreditServiceInterface;
use Workorder\Entity\WorkorderEntity;

class GetWorkorderCredit extends AbstractHelper
{
    /**
     * 
     * @var CreditServiceInterface
     */
    protected $creditService;
    
    /**
     * 
     * @param CreditServiceInterface $creditService
     */
    public function __construct(CreditServiceInterface $creditService)
    {
        $this->creditService = $creditService;
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
        
        $creditEntitys = $this->creditService->getWorkorderCredit($workorderEntity->getWorkorderId());
        
        $data->workorderEntity = $workorderEntity;
        
        $data->creditEntitys = $creditEntitys;
        
        $data->displayLinks = $displayLinks;
        
        return $partialHelper('partials/get-workorder-credit.phtml', $data);
    }
}

