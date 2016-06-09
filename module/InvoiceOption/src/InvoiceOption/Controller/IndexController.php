<?php
namespace InvoiceOption\Controller;

use Application\Controller\BaseController;
use InvoiceOption\Service\OptionServiceInterface;
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
            ->getAuthId(), 'Admin Invoice Options');
        
        $this->layout()->setVariable('pageTitle', 'Invoice Options');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $optionsEntity = $this->optionService->get(1);
        
        return new ViewModel(array(
            'optionsEntity' => $optionsEntity
        ));
        
    }
}