<?php
namespace Phone\Service;

use Phone\Entity\PhoneEntity;
use Phone\Mapper\PhoneMapperInterface;

class PhoneService implements PhoneServiceInterface
{

    /**
     *
     * @var PhoneMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param PhoneMapperInterface $mapper            
     */
    public function __construct(PhoneMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Phone\Service\PhoneServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Phone\Service\PhoneServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Phone\Service\PhoneServiceInterface::getPrimaryPhoneByLocation()
     */
    public function getPrimaryPhoneByLocation($locationId)
    {
        return $this->mapper->getPrimaryPhoneByLocation($locationId);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Phone\Service\PhoneServiceInterface::save()
     */
    public function save(PhoneEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Phone\Service\PhoneServiceInterface::delete()
     */
    public function delete(PhoneEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}