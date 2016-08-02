<?php
namespace Ticket\Mapper;

use Ticket\Entity\TicketEntity;

interface MysqlMapperInterface
{
    /**
     *
     * @param array $filter
     * @return TicketEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return TicketEntity
     */
    public function get($id);
    
    /**
     *
     * @param TicketEntity $entity
     * @return TicketEntity
     */
    public function save(TicketEntity $entity);
    
    /**
     *
     * @param TicketEntity $entity
     * @return boolean
     */
    public function delete(TicketEntity $entity);
}

