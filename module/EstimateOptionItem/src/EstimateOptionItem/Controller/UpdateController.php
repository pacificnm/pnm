<?php
namespace EstimateOptionItem\Controller;

use Application\Controller\BaseController;
use Estimate\Service\EstimateServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use EstimateOptionItem\Service\ItemServiceInterface;
use Zend\View\Model\ViewModel;
use EstimateOptionItem\Form\ItemForm;

class UpdateController extends BaseController
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
     * @var ItemForm
     */
    protected $itemForm;
    
    /**
     * 
     * @param EstimateServiceInterface $estimateService
     * @param OptionServiceInterface $optionService
     * @param ItemServiceInterface $itemService
     * @param ItemForm $itemForm
     */
    public function __construct(EstimateServiceInterface $estimateService, OptionServiceInterface $optionService, ItemServiceInterface $itemService, ItemForm $itemForm)
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