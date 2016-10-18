<?php
namespace WorkorderEmail\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use WorkorderEmail\Entity\WorkorderEmailEntity;


class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     * 
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param WorkorderEmailEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderEmailEntity $prototype)
    {
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    
        parent::__construct($readAdapter, $writeAdapter);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('workorder_email');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('workorder_email');
        
        $this->select->where(array(
            'workorder_email.workorder_email_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Mapper\MysqlMapperInterface::save()
     */
    public function save(WorkorderEmailEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getWorkorderEmailId()) {
            $this->update = new Update('workorder_email');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'workorder_email.workorder_email_id = ?' => $entity->getWorkorderEmailId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('workorder_email');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setWorkorderEmailId($id);
        }
        
        return $this->get($entity->getWorkorderEmailId());
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(WorkorderEmailEntity $entity)
    {
        $this->delete = new Delete('workorder_email');
        
        $this->delete->where(array(
            'workorder_email.workorder_email_id = ?' => $entity->getWorkorderEmailId()
        ));
        
        return $this->deleteRow();
    }
    
    protected function filter($filter)
    {
        
    }
}