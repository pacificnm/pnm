<?php
namespace Vendor\Service;

use Vendor\Entity\VendorEntity;
use Vendor\Mapper\VendorMapperInterface;

class VendorService implements VendorServiceInterface
{

    /**
     *
     * @var VendorMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param VendorMapperInterface $mapper            
     */
    public function __construct(VendorMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Vendor\Service\VendorServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Vendor\Service\VendorServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Vendor\Service\VendorServiceInterface::save()
     */
    public function save(VendorEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Vendor\Service\VendorServiceInterface::delete()
     */
    public function delete(VendorEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}