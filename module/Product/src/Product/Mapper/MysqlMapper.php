<?php
namespace Product\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use Product\Entity\ProductEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ProductEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ProductEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('product');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('product');
        
        $this->select->where(array(
            'product.product_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Mapper\MysqlMapperInterface::save()
     */
    public function save(ProductEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getProductId()) {
            $this->update = new Update('product');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'product.product_id = ?' => $entity->getProductId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('product');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setProductId($id);
        }
        
        return $this->get($entity->getProductId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Product\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(ProductEntity $entity)
    {
        $this->delete = new Delete('product');
        
        $this->delete->where(array(
            'product.product_id = ?' => $entity->getProductId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \Product\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}