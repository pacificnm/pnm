<?php
namespace HostAttribute\Controller;

use Application\Controller\BaseController;
use HostAttribute\Service\AttributeServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var AttributeServiceInterface
     */
    protected $attributeService;
    
    /**
     * 
     * @param AttributeServiceInterface $attributeService
     */
    public function __construct(AttributeServiceInterface $attributeService)
    {
        $this->attributeService = $attributeService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $attributeEntitys = $this->attributeService->getAll(array());
        
        $this->layout()->setVariable('pageTitle', 'Host Attribute');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-attribute-index');
        
        return new ViewModel(array(
            'attributeEntitys' => $attributeEntitys
        ));
    }
}