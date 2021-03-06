<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Location\Service;

use Location\Entity\LocationEntity;
use Location\Mapper\LocationMapperInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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
    
    /**
     * 
     * {@inheritDoc}
     * @see \Location\Service\LocationServiceInterface::getClientLocations()
     */
    public function getClientLocations($clientId)
    {
        $filter = array(
            'clientId' => $clientId,
            'locationStatus' => 'Active'
        );
        
        return $this->mapper->getAll($filter);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Location\Service\LocationServiceInterface::getClientBillingLocation()
     */
    public function getClientBillingLocation($clientId)
    {
        $locationEntity = $this->mapper->getClientLocationByType($clientId, 'Billing');
        
        if(! $locationEntity) {
            $locationEntity = $this->mapper->getClientLocationByType($clientId, 'Primary');
        }
        
        return $locationEntity;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Location\Service\LocationServiceInterface::clientHasPrimaryLocation()
     */
    public function clientHasPrimaryLocation($clientId)
    {
        $locationEntity = $this->mapper->getClientLocationByType($clientId, 'Primary');
        
        if(! $locationEntity) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Location\Service\LocationServiceInterface::getClientLocationByType()
     */
    public function getClientLocationByType($clientId, $locationType)
    {
        return $this->mapper->getClientLocationByType($clientId, $locationType);
    }
}