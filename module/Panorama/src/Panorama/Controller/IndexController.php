<?php
namespace Panorama\Controller;

use Application\Controller\BaseController;
use Panorama\Service\MspServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{

    /**
     *
     * @var MspServiceInterface
     */
    protected $mspService;

    /**
     *
     * @param MspServiceInterface $mspService            
     */
    public function __construct(MspServiceInterface $mspService)
    {
        $this->mspService = $mspService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $paginator = $this->mspService->getClientsSummary();
        
        // set layout vars
        $this->layout()->setVariable('pageTitle', 'Panorama9');
        
        $this->layout()->setVariable('pageSubTitle', 'Home');
        
        $this->layout()->setVariable('activeMenuItem', 'panorama-index');
        
        $this->layout()->setVariable('activeSubMenuItem', 'panorama-index');
        
        return new ViewModel(array(
            'paginator' => $paginator
        ));
    }
}