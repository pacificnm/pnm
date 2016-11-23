<?php
namespace Panorama\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Panorama\Service\IssueServiceInterface;
use Panorama\Service\MspServiceInterface;

class GetAllIssues extends AbstractHelper
{
    /**
     * 
     * @var IssueServiceInterface
     */
    protected $issueService;
    
    /**
     * 
     * @var MspServiceInterface
     */
    protected $mspService;
    
    /**
     * 
     * @param IssueServiceInterface $issueService
     * @param MspServiceInterface $mspService
     */
    public function __construct(IssueServiceInterface $issueService, MspServiceInterface $mspService)
    {
        $this->issueService = $issueService;
        
        $this->mspService = $mspService;
    }
    
    /**
     * 
     */
    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        try {
            $mspEntitys = $this->mspService->getClientsSummary();
            $data->paginator = $mspEntitys;
        } catch (\Exception $e) {
            $data->paginator = array();
        }
       
        
        return $partialHelper('partials/get-all-issues.phtml', $data);
    }
}