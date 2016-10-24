<?php
namespace Log\Controller;

use Application\Controller\BaseController;
use Log\Service\LogServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var LogServiceInterface
     */
    protected $logService;
    
    /**
     * 
     * @param LogServiceInterface $logService
     */
    public function __construct(LogServiceInterface $logService)
    {
        $this->logService = $logService;
        
    }
    
    public function indexAction()
    {
        $logFiles = $this->logService->getLogFiles();
        
        
        // return view
        return new ViewModel(array(
            'logFiles' => $logFiles
        ));
    }
}

?>