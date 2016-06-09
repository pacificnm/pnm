<?php
namespace Location\Service;

use Location\Entity\LocationEntity;
use Location\Mapper\LocationMapperInterface;

class LocationService implements LocationServiceInterface
{

    /**
     *
     * @var LocationMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param LocationMapperInterface $mapper            
     */
    public function __construct(LocationMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Location\Service\LocationServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Location\Service\LocationServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Location\Service\LocationServiceInterface::save()
     */
    public function save(LocationEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Location\Service\LocationServiceInterface::delete()
     */
    public function delete(LocationEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    public function getClientBillingLocation($clientId)
    {
        $locationEntity = $this->mapper->getClientLocationByType($clientId, 'Billing');
        
        if(! $locationEntity) {
            $locationEntity = $this->mapper->getClientLocationByType($clientId, 'Primary');
        }
        
        return $locationEntity;
    }
}