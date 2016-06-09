<?php
namespace Config\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Config\Service\ConfigServiceInterface;

class IndexController extends BaseController
{
    /**
     * 
     * @var ConfigServiceInterface
     */
    protected $configService;
    
    /**
     * 
     * @param ConfigServiceInterface $configService
     */
    public function __construct(ConfigServiceInterface $configService)
    {
        $this->configService = $configService;
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
            ->getAuthId(), 'Admin Config Options');
        
        $this->layout()->setVariable('pageTitle', 'Config');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $configEntity = $this->configService->get(1);
        
        return new ViewModel(array(
            'configEntity' => $configEntity
        ));
    }
}
