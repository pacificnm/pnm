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

        $this->layout()->setVariable('pageSubTitle', 'nigger');
        
        return new ViewModel(array(
            'paginator' => $paginator
        ));
    }
}