<?php
namespace WorkorderPart\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\ResultSet;
use WorkorderPart\Entity\PartEntity;

class PartMapper implements PartMapperInterface
{

    /**
     *
     * @var AdapterInterface
     */
    protected $readAdapter;

    /**
     *
     * @var AdapterInterface
     */
    protected $writeAdapter;

    /**
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     *
     * @var NoteEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param NoteEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PartEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Mapper\PartMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_parts');
        
        // workorderId
        if (array_key_exists('workorderId', $filter) && ! empty($filter['workorderId'])) {
            $select->where(array(
                'workorder_parts.workorder_id = ?' => $filter['workorderId']
            ));
        }
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result);
        }
        
        return array();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Mapper\PartMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_parts');
        
        $select->where(array(
            'workorder_parts.workorder_parts_id = ?' => $id
        ));
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result)->current();
        }
        
        return array();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Mapper\PartMapperInterface::save()
     */
    public function save(PartEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderPartsId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_parts');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_parts.workorder_parts_id = ?' => $entity->getWorkorderPartsId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_parts');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderPartsId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Mapper\PartMapperInterface::delete()
     */
    public function delete(PartEntity $entity)
    {
        $action = new Delete('workorder_parts');
        
        $action->where(array(
            'workorder_parts.workorder_parts_id = ?' => $entity->getWorkorderPartsId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}