<?php
namespace History\View\Helper;

use Zend\View\Helper\AbstractHelper;
use History\Service\HistoryServiceInterface;

class GetAuthHistory extends AbstractHelper
{
    /**
     * 
     * @var HistoryServiceInterface
     */
    protected $historyService;
    
    /**
     * 
     * @param HistoryServiceInterface $historyService
     */
    public function __construct(HistoryServiceInterface $historyService)
    {
        $this->historyService = $historyService;
    }
    
    /**
     * 
     */
    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $historyEntitys = $this->historyService->getAll(array('authId' => $view->Identity()->getAuthId()));
        
        $data = new \stdClass();
        
        $data->historyEntitys = $historyEntitys;
        
        return $partialHelper('partials/get-auth-history.phtml', $data);
    }
}
