<?php
namespace PanoramaHost\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use PanoramaHost\Service\PanoramaHostServiceInterface;
use Host\Service\HostServiceInterface;
use Panorama\Service\MspServiceInterface;
use PanoramaClient\Service\PanoramaClientServiceInterface;
use Panorama\Service\DeviceServiceInterface;
use HostType\Service\TypeServiceInterface;
use Location\Service\LocationServiceInterface;
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
     * @var PanoramaClientServiceInterface
     */
    protected $panoramaClientService;

    /**
     *
     * @var PanoramaHostServiceInterface
     */
    protected $panoramaHostService;

    /**
     *
     * @var HostServiceInterface
     */
    protected $hostService;

    /**
     * 
     * @var DeviceServiceInterface
     */
    protected $deviceService;

    /**
     * 
     * @var TypeServiceInterface
     */
    protected $hostTypeService;
    
    protected $locationService;
    
    protected $logService;
    
    protected $writerService;
    
    
    /**
     * 
     * @param MspServiceInterface $mspService
     * @param PanoramaClientServiceInterface $panoramaClientService
     * @param PanoramaHostServiceInterface $panoramaHostService
     * @param HostServiceInterface $hostService
     * @param DeviceServiceInterface $deviceService
     * @param TypeServiceInterface $hostTypeService
     */
    public function __construct(MspServiceInterface $mspService, PanoramaClientServiceInterface $panoramaClientService, PanoramaHostServiceInterface $panoramaHostService, HostServiceInterface $hostService, DeviceServiceInterface $deviceService, TypeServiceInterface $hostTypeService, LocationServiceInterface $locationService)
    {
        $this->mspService = $mspService;
        
        $this->panoramaClientService = $panoramaClientService;
        
        $this->panoramaHostService = $panoramaHostService;
        
        $this->hostService = $hostService;
        
        $this->deviceService = $deviceService;
        
        $this->hostTypeService = $hostTypeService;
        
        $this->locationService = $locationService;
        
        $this->logService = new Logger();
        
        $this->writerService = new Stream('./data/log/' . date('Y-m-d') . '-panorama-host-sync.log');
        
        $this->logService->addWriter($this->writerService);
    }

    /**
     * 
     * @throws RuntimeException
     */
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
        
        foreach ($mspEntitys as $mspEntity) {
            // fecth client
            $panoramaClientEntity = $this->panoramaClientService->getByCid($mspEntity->getCid());
            
            if ($panoramaClientEntity->getPanoramaClientId()) {
                
                $console->write("Client found {$panoramaClientEntity->getClientId()}, {$panoramaClientEntity->getClientEntity()->getClientName()}\n", 3);
                
                $this->logService->info("Client found {$panoramaClientEntity->getClientId()}, {$panoramaClientEntity->getClientEntity()->getClientName()}");
                
                // check we have location information
                if(! $this->getLocationId($panoramaClientEntity->getClientId())) {
                    $console->write("Client missing location information\n", 2);
                    
                    continue;
                }
                
                // get devices from panorama
                $deviceEntitys = $this->deviceService->getDevices($mspEntity->getCid());
                
                foreach($deviceEntitys as $deviceEntity) {
                    // check if we already have the host
                    $panoramaHostEntity = $this->panoramaHostService->getByDeviceId($deviceEntity->getDeviceId());
                    
                    // check if we do not have a host
                    if(! $panoramaHostEntity) {
                        
                                               
                        $clientId = $panoramaClientEntity->getClientId();
                        
                        $hostDescription = $deviceEntity->getAlias();
                        
                        $hostHealth = 'Ok';
                        
                        $hostIp = $deviceEntity->getNetworkEntity()->getIpv4Entity()->getIp();
                        
                        $hostName = $deviceEntity->getName();
                        
                        $hostStatus = 'Active';
                        
                        $hostTypeId = $this->getHostTypeId($deviceEntity->getDeviceType());
                        
                        $locationId = $this->getLocationId($panoramaClientEntity->getClientId());
                        
                                          
                        $hostEntity = $this->hostService->create($clientId, $hostDescription, $hostHealth, $hostIp, $hostName, $hostStatus, $hostTypeId, $locationId);
                        
                        // map host
                        $this->panoramaHostService->createPanoramaHost($hostEntity->getHostId(), $deviceEntity->getDeviceId());
                        
                        $console->write("New host created\n", 3);
                        
                        $this->logService->info("New host created");
                        
                    } else {
                        // do update
                        $console->write("Skipping host already sync\n");
                        
                        $this->logService->info("Skipping host already sync");
                    }
                }
            } else {
                $console->write("No client found for {$mspEntity->getName()}\n", 2);
                
                $this->logService->info("No client found for {$mspEntity->getName()}");
            }
        }
        
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Completed Panorama Client Sync at {$end}\n", 3);
        
        $this->logService->info("Completed Panorama Client Sync at {$end}");
    }
    
    /**
     * 
     * @param string $hostTypeName
     * @return \HostType\Entity\the|number
     */
    protected function getHostTypeId($hostTypeName)
    {
        print $hostTypeName;
        
        $hostTypeEntity = $this->hostTypeService->getTypeByName(ucfirst(strtolower($hostTypeName)));
        
        if($hostTypeEntity) {
            return $hostTypeEntity->getHostTypeId();
        } else {
            if($hostTypeName == 'computer') {
                // workstation
                return 1;
            } else {
                // 12 is other
                return 12;
            }
        }
        
    }
    
    /**
     * 
     * @param number $clientId
     * @return number
     */
    protected function getLocationId($clientId)
    {
        $locationEntity = $this->locationService->getClientLocationByType($clientId, 'Primary');

        
        if(! $locationEntity) {
            return false;
        } else {
            return $locationEntity->getLocationId();
        }
    }
}