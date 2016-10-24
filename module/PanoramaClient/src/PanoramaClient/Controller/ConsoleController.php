<?php
namespace PanoramaClient\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Panorama\Service\MspServiceInterface;
use Client\Service\ClientServiceInterface;
use PanoramaClient\Service\PanoramaClientServiceInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class ConsoleController extends AbstractActionController
{
    /**
     * 
     * @var MspServiceInterface
     */
    protected $mspService;
    
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     * 
     * @var PanoramaClientServiceInterface
     */
    protected $panoramaClientService;
    
    protected $logService;
    
    protected $writerService;
    
    /**
     * 
     * @param MspServiceInterface $mspService
     * @param ClientServiceInterface $clientService
     * @param PanoramaClientServiceInterface $panoramaClientService
     */
    public function __construct(MspServiceInterface $mspService, ClientServiceInterface $clientService, PanoramaClientServiceInterface $panoramaClientService)
    {
        $this->mspService = $mspService;
        
        $this->clientService = $clientService;
        
        $this->panoramaClientService = $panoramaClientService;
        
        $this->logService = new Logger();
        
        $this->writerService = new Stream('./data/log/' . date('Y-m-d') . '-panorama-client-sync.log');
        
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
        
        $console->write("Start Panorama Client Sync at {$start}\n", 3);
        
        $this->logService->info("Start Panorama Client Sync at {$start}");
        
        $mspEntitys = $this->mspService->getClients();
        
        foreach($mspEntitys as $mspEntity) {
            $console->write("Working on {$mspEntity->getName()}\n");
            
            $this->logService->info("Working on {$mspEntity->getName()}");
            
            // check if we already have client mapped
            $panoramaClientEntity = $this->panoramaClientService->getByCid($mspEntity->getCid());
            
            if(! $panoramaClientEntity) {
                
                // find client by name
                $clientEntity = $this->clientService->getClientByName($mspEntity->getName());
                
                if($clientEntity) {
                    $entity = $this->panoramaClientService->create($clientEntity->getClientId(), $mspEntity->getCid());
                    
                    $console->write("Sync {$mspEntity->getName()}\n", 3);
                    
                    $this->logService->info("Sync {$mspEntity->getName()}");
                } else {
                    // create new client
                    $clientEntity = $this->clientService->createClient($mspEntity->getName(), 'Active');
                    
                    // map
                    $this->panoramaClientService->create($clientEntity->getClientId(), $mspEntity->getCid());
                    
                    $console->write("Sync {$mspEntity->getName()}\n", 3);
                    
                    $this->logService->info("Sync {$mspEntity->getName()}");
                }
            } else {
                $console->write("Skipping sync of {$mspEntity->getName()}, already synced.\n");
                
                $this->logService->info("Skipping sync of {$mspEntity->getName()}, already synced TODO Change to Update");
            }
        }
        
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Completed Panorama Client Sync at {$end}\n", 3);
        
        $this->logService->info("Completed Panorama Client Sync at {$end}");
    }
}
