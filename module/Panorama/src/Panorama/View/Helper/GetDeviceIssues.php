<?php
namespace Panorama\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Panorama\Service\IssueServiceInterface;

class GetDeviceIssues extends AbstractHelper
{
    /**
     * 
     * @var IssueServiceInterface
     */
    protected $issueService;
    
    /**
     * 
     * @param IssueServiceInterface $issueService
     */
    public function __construct(IssueServiceInterface $issueService)
    {
        $this->issueService = $issueService;
    }
    
    /**
     * 
     * @param number $cid
     * @param number $deviceId
     */
    public function __invoke($cid, $deviceId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $issueEntitys = $this->issueService->getDeviceIssues($cid, $deviceId);
        
        $data->issueEntitys = $issueEntitys;
        
        return $partialHelper('partials/get-device-issues.phtml', $data);
    }
}
