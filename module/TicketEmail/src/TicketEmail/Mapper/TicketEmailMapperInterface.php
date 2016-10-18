<?php
namespace TicketEmail\Mapper;

use TicketEmail\Entity\TicketEmailEntity;

interface TicketEmailMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return TicketEmailEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return TicketEmailEntity
     */
    public function get($id);

    /**
     *
     * @param TicketEmailEntity $entity            
     * @return TicketEmailEntity
     */
    public function save(TicketEmailEntity $entity);

    /**
     *
     * @param TicketEmailEntity $entity            
     * @return TicketEmailEntity
     */
    public function delete(TicketEmailEntity $entity);
}