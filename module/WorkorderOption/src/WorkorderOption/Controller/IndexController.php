<?php
namespace WorkorderOption\Controller;

use Application\Controller\BaseController;
use WorkorderOption\Service\OptionServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var OptionServiceInterface
     */
    protected $optionService;
    
    /**
     * 
     * @param OptionServiceInterface $optionService
     */
    public function __construct(OptionServiceInterface $optionService)
    {
        $this->optionService = $optionService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'Admin Work Order Options');
        
        $this->layout()->setVariable('pageTitle', 'Work Order Options');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $optionEntity = $this->optionService->get(1);
        
        return new ViewModel(array(
            'optionEntity' => $optionEntity
        ));
    }
}

