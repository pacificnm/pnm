<?php
namespace WorkorderTicket\Mapper;

use WorkorderTicket\Entity\WorkorderTicketEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return PartEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PartEntity
     */
    public function get($id);

    /**
     *
     * @param PartEntity $entity            
     * @return PartEntity
     */
    public function save(WorkorderTicketEntity $entity);

    /**
     *
     * @param PartEntity $entity            
     * @return boolean
     */
    public function delete(WorkorderTicketEntity $entity);
}

