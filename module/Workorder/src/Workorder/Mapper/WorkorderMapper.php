<?php
namespace Workorder\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Workorder\Entity\WorkorderEntity;

class WorkorderMapper implements WorkorderMapperInterface
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
     * @var WorkorderEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderEntity $prototype)
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
     * @see \Workorder\Mapper\WorkorderMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        // client id
        if (array_key_exists('clientId', $filter) && ! empty($filter['clientId'])) {
            $select->where(array(
                'workorder.client_Id = ?' => $filter['clientId']
            ));
        }
        
        // workorder status
        if (array_key_exists('workorderStatus', $filter) && ! empty($filter['workorderStatus'])) {
            $select->where(array(
                'workorder.workorder_status = ?' => $filter['workorderStatus']
            ));
        }
        
        // keyword
        if (array_key_exists('keyword', $filter) && ! empty($filter['keyword'])) {
            if (is_numeric($filter['keyword'])) {
                $select->where(array(
                    'workorder.workorder_id = ?' => $filter['keyword']
                ));
            } else {
                $select->where->like('workorder.workorder_description', $filter['keyword'] . "%");
            }
        }
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $select->where(array(
            'workorder.workorder_id = ?' => $id
        ));
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
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
     * @see \Workorder\Mapper\WorkorderMapperInterface::save()
     */
    public function save(WorkorderEntity $workorderEntity)
    {
        $postData = $this->hydrator->extract($workorderEntity);
        
        if ($workorderEntity->getWorkorderId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder.workorder_id = ?' => $workorderEntity->getWorkorderId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $workorderEntity->setWorkorderId($newId);
            }
            
            return $workorderEntity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::delete()
     */
    public function delete(WorkorderEntity $workorderEntity)
    {
        $action = new Delete('workorder');
        
        $action->where(array(
            'workorder.workorder_id = ?' => $workorderEntity->getWorkorderId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}