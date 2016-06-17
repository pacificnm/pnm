<?php
namespace HostType\Controller;

use Application\Controller\BaseController;
use HostType\Service\TypeServiceInterface;
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
    
    public function indexAction()
    {
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'Admin Host Types');
        
        $typeEntitys = $this->typeService->getAll(array());
        
        $this->layout()->setVariable('pageTitle', 'Host Type');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-type-index');
        
        return new ViewModel(array(
            'typeEntitys' => $typeEntitys,
        ));
    }
}