<?php
namespace Ticket\Mapper;

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
use Ticket\Entity\TicketEntity;
use Application\Mapper\CoreMysqlMapper;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{
    
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param TicketEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, TicketEntity $prototype)
    {
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Ticket\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('ticket');
        
        $this->joinUser();
        
        $this->filter($filter);
        
        $this->select->order('ticket.ticket_date_open DESC');
        
        return $this->getPaginator();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Ticket\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('ticket');
        
        $this->joinUser();
        
        $this->select->where(array(
            'ticket.ticket_id = ?' => $id
        ));
        
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Ticket\Mapper\MysqlMapperInterface::save()
     */
    public function save(TicketEntity $entity)
    {
        
        $postData = $this->hydrator->extract($entity);   
       
        
        if ($entity->getTicketId()) {
        
            // ID present, it's an Update
            $action = new Update('ticket');
        
            $action->set($postData);
        
            $action->where(array(
                'ticket.ticket_id = ?' => $entity->getTicketId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('ticket');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setTicketId($newId);
            }
        
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Ticket\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(TicketEntity $entity)
    {
        $action = new Delete('ticket');
        
        $action->where(array(
            'ticket.ticket_id = ?' => $entity->getTicketId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
    
    protected function joinUser()
    {
        $this->select->join('user', 'ticket.user_id = user.user_id', array(
            'location_id',
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'inner');
        
        return $this;
    }
    
    protected function filter($filter)
    {
        if(array_key_exists('clientId', $filter)) {
            $this->select->where(array('ticket.client_id = ?' => $filter['clientId']));
        }
        
        if(array_key_exists('ticketStatus', $filter) && ! empty($filter['ticketStatus'])) {
            if($filter['ticketStatus'] == 'Open') {
                $this->select->where(array('ticket.ticket_status != ?' => 'Closed'));
            } else {
                $this->select->where(array('ticket.ticket_status = ?' => $filter['ticketStatus']));
            }
        }
        
        return $this;
    }
}

