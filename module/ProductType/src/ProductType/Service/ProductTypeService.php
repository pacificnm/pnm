<?php
namespace ProductType\Service;

use ProductType\Entity\ProductTypeEntity;
use ProductType\Mapper\MysqlMapperInterface;

class ProductTypeService implements ProductTypeServiceInterface
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
     * {@inheritdoc}
     *
     * @see \ProductType\Service\ProductTypeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ProductType\Service\ProductTypeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ProductType\Service\ProductTypeServiceInterface::save()
     */
    public function save(ProductTypeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ProductType\Service\ProductTypeServiceInterface::delete()
     */
    public function delete(ProductTypeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

