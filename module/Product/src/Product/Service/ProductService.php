<?php
namespace Product\Service;

use Product\Entity\ProductEntity;
use Product\Mapper\MysqlMapperInterface;

class ProductService implements ProductServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Service\ProductServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Service\ProductServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Service\ProductServiceInterface::getActiveProducts()
     */
    public function getActiveProducts()
    {
        return $this->mapper->getActiveProducts();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Service\ProductServiceInterface::save()
     */
    public function save(ProductEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Service\ProductServiceInterface::delete()
     */
    public function delete(ProductEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}