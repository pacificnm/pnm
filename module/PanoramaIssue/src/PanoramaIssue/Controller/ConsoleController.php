<?php
namespace PanoramaIssue\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Panorama\Service\MspServiceInterface;
use Panorama\Service\IssueServiceInterface;
use PanoramaIssue\Service\PanoramaIssueServiceInterface;
use PanoramaClient\Service\PanoramaClientServiceInterface;
use PanoramaIssue\Entity\PanoramaIssueEntity;

class ConsoleController extends AbstractActionController
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
     * @var PanoramaIssueServiceInterface
     */
    protected $panoramaIssueService;

    /**
     * 
     * @var PanoramaClientServiceInterface
     */
    protected $panoramaClientService;
    /**
     *
     * @var Logger
     */
    protected $logService;

    /**
     *
     * @var Stream
     */
    protected $writerService;

    /**
     * 
     * @param MspServiceInterface $mspService
     * @param IssueServiceInterface $issueService
     * @param PanoramaIssueServiceInterface $panoramaIssueService
     * @param PanoramaClientServiceInterface $panoramaClientService
     */
    public function __construct(MspServiceInterface $mspService, IssueServiceInterface $issueService, PanoramaIssueServiceInterface $panoramaIssueService, PanoramaClientServiceInterface $panoramaClientService)
    {
        $this->mspService = $mspService;
        
        $this->issueService = $issueService;
        
        $this->panoramaIssueService = $panoramaIssueService;
        
        $this->panoramaClientService = $panoramaClientService;
        
        $this->logService = new Logger();
        
        $this->writerService = new Stream('./data/log/' . date('Y-m-d') . '-panorama-issue-sync.log');
        
        $this->logService->addWriter($this->writerService);
    }

    public function syncAction()
    {
        // load request
        $request = $this->getRequest();
        
        // validate we are in a console
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($request));
        }
        
        // load console
        $console = $this->getServiceLocator()->get('console');
        
        $start = date('m/d/Y h:i a', time());
        
        $console->write("Start Panorama Issue Sync at {$start}\n", 3);
        
        $this->logService->info("Start Panorama Issue Sync at {$start}");
        
        $mspEntitys = $this->mspService->getClients();
        
        foreach($mspEntitys as $mspEntity) {
            
            $panoramaClientEntity = $this->panoramaClientService->getByCid($mspEntity->getCid());
            
            if($panoramaClientEntity) {
                $console->write("Client found #{$panoramaClientEntity->getClientId()}, {$panoramaClientEntity->getClientEntity()->getClientName()}\n", 3);
            
                $this->logService->info("Client found #{$panoramaClientEntity->getClientId()}, {$panoramaClientEntity->getClientEntity()->getClientName()}");
            
                // load all client issues
                $issueEntitys = $this->issueService->getAllIssues($mspEntity->getCid());
                
                if($issueEntitys) {
                    $count = count($issueEntitys);
                    
                    $console->write("Client {$mspEntity->getName()} has {$count} issues\n");
                    
                    $this->logService->info("Client {$mspEntity->getName()} has {$count} issues");
                    
                    foreach($issueEntitys as $issueEntity) {
                        // get panoramaIssue
                        $entity = $this->panoramaIssueService->get($issueEntity->getIssueId());
                        
                        // import issue
                        $panoramaIssueEntity = new PanoramaIssueEntity();
                        
                        $panoramaIssueEntity->setClientId($panoramaClientEntity->getClientId());
                        
                        $panoramaIssueEntity->setPanoramaIssueId($issueEntity->getIssueId());
                        
                        $panoramaIssueEntity->setPanoramaIssueArea($issueEntity->getArea());
                        
                        $panoramaIssueEntity->setPanoramaIssueCategory($issueEntity->getCategory());
                        
                        $panoramaIssueEntity->setPanoramaIssueFirstSeen(strtotime($issueEntity->getFirstSeen()));
                        
                        $panoramaIssueEntity->setPanoramaIssueItemId($issueEntity->getItemId());
                        
                        $panoramaIssueEntity->setPanoramaIssueLastSeen(strtotime($issueEntity->getLastSeen()));
                        
                        $panoramaIssueEntity->setPanoramaIssueMessage($issueEntity->getMessage());
                        
                        $panoramaIssueEntity->setPanoramaIssueResolved($issueEntity->getResolved());
                        
                        if($issueEntity->getResolvedTime() == "NULL") {
                            $panoramaIssueEntity->setPanoramaIssueResolvedTime(0);
                        } else {
                            $panoramaIssueEntity->setPanoramaIssueResolvedTime(strtotime($issueEntity->getResolvedTime()));
                        }
                        
                        $panoramaIssueEntity->setPanoramaIssueSnoozed($issueEntity->getSnoozed());
                        
                        $panoramaIssueEntity->setPanoramaIssueType($issueEntity->getType());
                        
                        $panoramaIssueEntity->setPanoramaIssueVulnerability($issueEntity->getVulnerability());
                        
                        
                        if(!$entity) {
                           
                            $panoramaIssueEntity = $this->panoramaIssueService->createIssue($panoramaIssueEntity);
                            
                            $console->write("Saved issue #{$issueEntity->getIssueId()}\n", 3);
                    
                            $this->logService->info("Saved issue #{$issueEntity->getIssueId()}");
                            
                        } else {
                            // update issue
                            $panoramaIssueEntity = $this->panoramaIssueService->updateIssue($panoramaIssueEntity);
                            
                            $console->write("Saved issue #{$issueEntity->getIssueId()}\n", 3);
                            
                            $this->logService->info("Saved issue #{$issueEntity->getIssueId()}");
                        }
                    }
                    
                } else {
                    $console->write("Client {$mspEntity->getName()} has no issues\n", 2);
                    
                    $this->logService->info("Client {$mspEntity->getName()} has no issues");
                }
                
            } else {
                $console->write("No client found for {$mspEntity->getName()}\n");
                
                $this->logService->info("No client found for {$mspEntity->getName()}");
            }
        }
        
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Completed Panorama Issue Sync at {$end}\n", 3);
        
        $this->logService->info("Completed Panorama Issue Sync at {$end}");
    }
}
