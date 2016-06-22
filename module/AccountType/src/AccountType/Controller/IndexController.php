<?php
namespace AccountType\Controller;

use Application\Controller\BaseController;
use AccountType\Service\TypeServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var TypeServiceInterface
     */
    protected $typeService;
    
    /**
     * 
     * @param TypeServiceInterface $typeService
     */
    public function __construct(TypeServiceInterface $typeService)
    {
        
        $this->typeService = $typeService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // get account entitys
        $typeEntitys = $this->typeService->getAll(array());
        
        $this->layout()->setVariable('pageTitle', 'Account Types');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        // return view
        return new ViewModel(array(
            'typeEntitys' => $typeEntitys
        ));
    }
}