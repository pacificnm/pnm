<?php
namespace HostFile\View\Helper;

use Zend\View\Helper\AbstractHelper;
use HostFile\Service\HostFileServiceInterface;

class HostFile extends AbstractHelper
{
    /**
     * 
     * @var HostFileServiceInterface
     */
    protected $hostFileService;
    
    /**
     * 
     * @param number $hostId
     */
    public function __invoke($hostId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $paginator = $this->hostFileService->getHostFiles($hostId);
        
        $data->paginator = $paginator;
        
        $data->hostId = $hostId;
        
        return $partialHelper('partials/host-file.phtml', $data);
    }
    
    /**
     * 
     * @param HostFileServiceInterface $hostFileService
     */
    public function __construct(HostFileServiceInterface $hostFileService)
    {
        $this->hostFileService = $hostFileService;
    }
    
}
