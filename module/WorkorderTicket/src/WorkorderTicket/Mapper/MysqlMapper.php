<?php
namespace WorkorderTicket\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\ResultSet;
use WorkorderTicket\Entity\WorkorderTicketEntity;

class MysqlMapper implements MysqlMapperInterface
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
     * @var WorkorderTicketEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderTicketEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderTicketEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_ticket');
        
        // workorderId
        if (array_key_exists('workorderId', $filter) && ! empty($filter['workorderId'])) {
            $select->where(array(
                'workorder_ticket.workorder_id = ?' => $filter['workorderId']
            ));
        }
        
        if (array_key_exists('ticketId', $filter) && ! empty($filter['ticketId'])) {
            $select->where(array(
                'workorder_ticket.ticket_id = ?' => $filter['ticketId']
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
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_ticket');
        
        $select->where(array(
            'workorder_ticket.workorder_ticket_id = ?' => $id
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
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Mapper\MysqlMapperInterface::save()
     */
    public function save(WorkorderTicketEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderTicketId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_ticket');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_ticket.workorder_ticket_id = ?' => $entity->getWorkorderTicketId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_ticket');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderTicketId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(WorkorderTicketEntity $entity)
    {
        $action = new Delete('workorder_ticket');
        
        $action->where(array(
            'workorder_ticket.workorder_ticket_id = ?' => $entity->getWorkorderTicketId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}

