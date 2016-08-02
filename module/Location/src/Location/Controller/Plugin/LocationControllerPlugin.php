<?php
namespace Location\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Location\Service\LocationServiceInterface;

class LocationControllerPlugin extends AbstractPlugin
{
    /**
     * 
     * @var LocationServiceInterface
     */
    protected $locationService;
    
    /**
     * 
     * @param LocationServiceInterface $locationService
     */
    public function __construct(LocationServiceInterface $locationService)
    {
        $this->locationService = $locationService;
    }
    
    /**
     * 
     * @param unknown $locationId
     * @return \Location\Entity\LocationEntity
     */
    public function __invoke($locationId)
    {
        $locationEntity = $this->locationService->get($locationId);
        
        return $locationEntity;
    }
}

