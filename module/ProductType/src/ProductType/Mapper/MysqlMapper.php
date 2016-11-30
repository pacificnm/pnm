<?php
namespace ProductType\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use ProductType\Entity\ProductTypeEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ProductTypeEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ProductTypeEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ProductType\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('product_type');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ProductType\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('product_type');
        
        $this->select->where(array(
            'product_type.product_type_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ProductType\Mapper\MysqlMapperInterface::save()
     */
    public function save(ProductTypeEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getProductTypeId()) {
            $this->update = new Update('product_type');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'product_type.product_type_id = ?' => $entity->getProductTypeId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('product_type');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setProductTypeId($id);
        }
        
        return $this->get($entity->getProductTypeId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ProductType\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(ProductTypeEntity $entity)
    {
        $this->delete = new Delete('product_type');
        
        $this->delete->where(array(
            'product_type.product_type_id = ?' => $entity->getProductTypeId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \ProductType\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}

