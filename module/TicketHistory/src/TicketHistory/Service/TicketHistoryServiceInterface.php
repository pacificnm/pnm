<?php
namespace TicketHistory\Service;

use TicketHistory\Entity\TicketHistoryEntity;

interface TicketHistoryServiceInterface
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
     * @param number $ticketId
     * @param number $authId
     * @param string $historyUrl
     * @param string $historyAction
     * @param string $historyNote
     */
    public function create($ticketId, $authId, $historyUrl, $historyAction, $historyNote);
    
    /**
     *
     * @param TicketHistoryEntity $entity            
     * @return boolean
     */
    public function delete(TicketHistoryEntity $entity);
}