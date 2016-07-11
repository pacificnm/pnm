<?php
namespace EstimateOptionItem\Controller;

use Application\Controller\BaseController;
use Estimate\Service\EstimateServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use EstimateOptionItem\Service\ItemServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     *
     * @var EstimateServiceInterface
     */
    protected $estimateService;
    
    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;
    
    /**
     *
     * @var ItemServiceInterface
     */
    protected $itemService;
    
    /**
     *
     * @param EstimateServiceInterface $estimateService
     * @param OptionServiceInterface $optionService
     * @param ItemServiceInterface $itemService
     */
    public function __construct(EstimateServiceInterface $estimateService, OptionServiceInterface $optionService, ItemServiceInterface $itemService)
    {
        $this->estimateService = $estimateService;
    
        $this->optionService = $optionService;
    
        $this->itemService = $itemService;
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
    
        return new ViewModel();
    }
}

?>