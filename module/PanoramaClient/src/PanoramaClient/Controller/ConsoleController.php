<?php
namespace PanoramaClient\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Panorama\Service\MspServiceInterface;
use Client\Service\ClientServiceInterface;
use PanoramaClient\Service\PanoramaClientServiceInterface;

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
        
        $mspEntitys = $this->mspService->getClients();
        
        foreach($mspEntitys as $mspEntity) {
            $console->write("Working on {$mspEntity->getName()}\n");
            
            // check if we already have client mapped
            $panoramaClientEntity = $this->panoramaClientService->getByCid($mspEntity->getCid());
            
            if(! $panoramaClientEntity) {
                
                // find client by name
                $clientEntity = $this->clientService->getClientByName($mspEntity->getName());
                
                if($clientEntity) {
                    $entity = $this->panoramaClientService->create($clientEntity->getClientId(), $mspEntity->getCid());
                    
                    $console->write("Sync {$mspEntity->getName()}\n", 3);
                } else {
                    // create new client
                    $clientEntity = $this->clientService->createClient($mspEntity->getName(), 'Active');
                    
                    // map
                    $this->panoramaClientService->create($clientEntity->getClientId(), $mspEntity->getCid());
                    
                    $console->write("Sync {$mspEntity->getName()}\n", 3);
                }
            } else {
                $console->write("Skipping sync of {$mspEntity->getName()}, already synced.\n");
            }
        }
        
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Completed Panorama Client Sync at {$end}\n", 3);
    }
}
