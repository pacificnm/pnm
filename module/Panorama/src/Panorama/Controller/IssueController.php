<?php
namespace Panorama\Controller;

use Application\Controller\BaseController;
use Panorama\Service\IssueServiceInterface;
use Panorama\Service\MspServiceInterface;
use Zend\View\Model\ViewModel;
use PanoramaClient\Service\PanoramaClientServiceInterface;

class IssueController extends BaseController
{
    /**
     *
     * @var MspServiceInterface
     */
    protected $mspService;
    
    /**
     * 
     * @var IssueServiceInterface
     */
    protected $issueService;
    
    /**
     *
     * @var PanoramaClientServiceInterface
     */
    protected $panoramaClientService;
    
    /**
     * 
     * @param MspServiceInterface $mspService
     * @param IssueServiceInterface $issueService
     * @param PanoramaClientServiceInterface $panoramaClientService
     */
    public function __construct(MspServiceInterface $mspService, IssueServiceInterface $issueService, PanoramaClientServiceInterface $panoramaClientService)
    {
        $this->mspService = $mspService;
        
        $this->issueService = $issueService;
        
        $this->panoramaClientService = $panoramaClientService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $cid = $this->params('cid');
        
        $mspEntity = $this->mspService->getClient($cid);
        
        $issueEntitys = $this->issueService->getAllIssues($cid);
        
        $panoramaClientEntity = $this->panoramaClientService->getByCid($cid);
        
        return new ViewModel(array(
            'issueEntitys' => $issueEntitys,
            'mspEntity' => $mspEntity,
            'panoramaClientEntity' => $panoramaClientEntity
        ));
    }
}