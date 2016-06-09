<?php
namespace PaymentOption\Controller;

use Application\Controller\BaseController;
use PaymentOption\Service\OptionServiceInterface;
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
            ->getAuthId(), 'Admin Payment Options');
        
        $filter = array();
        
        $optionEntitys = $this->optionService->getAll($filter);
        
        $this->layout()->setVariable('pageTitle', 'Payment Options');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        return new ViewModel(array(
            'optionEntitys' => $optionEntitys
        ));
        
    }
}