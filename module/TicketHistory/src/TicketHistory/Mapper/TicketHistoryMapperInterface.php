<?php
namespace TicketHistory\Mapper;

use TicketHistory\Entity\TicketHistoryEntity;

interface TicketHistoryMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return TicketHistoryEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return TicketHistoryEntity
     */
    public function get($id);

    /**
     *
     * @param TicketHistoryEntity $entity            
     * @return TicketHistoryEntity
     */
    public function save(TicketHistoryEntity $entity);

    /**
     *
     * @param TicketHistoryEntity $entity            
     * @return boolean
     */
    public function delete(TicketHistoryEntity $entity);
}