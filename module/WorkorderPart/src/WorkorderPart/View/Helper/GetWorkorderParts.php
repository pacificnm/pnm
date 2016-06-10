<?php
namespace WorkorderPart\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderPart\Service\PartServiceInterface;
use Workorder\Entity\WorkorderEntity;

class GetWorkorderParts extends AbstractHelper
{

    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;

    /**
     *
     * @param PartServiceInterface $partService            
     */
    public function __construct(PartServiceInterface $partService)
    {
        $this->partService = $partService;
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
        
        $partsEntity = $this->partService->getWorkorderParts($workorderEntity->getWorkorderId());
        
        $data->workorderEntity = $workorderEntity;
        
        $data->displayLinks = $displayLinks;
        
        $data->partEntitys = $partsEntity;
        
        return $partialHelper('partials/get-workorder-parts.phtml', $data);
    }
}
