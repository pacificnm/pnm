<?php
namespace Panorama\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Panorama\Service\IssueServiceInterface;

class GetClientIssues extends AbstractHelper
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

    public function __invoke($cid)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        try {
            $issueEntitys = $this->issueService->getAllIssues($cid);
            $data->issueEntitys = $issueEntitys;
        } catch (\Exception $e) {
            $data->issueEntitys = array();
        }
        
        
        return $partialHelper('partials/get-client-issues.phtml', $data);
    }
}
