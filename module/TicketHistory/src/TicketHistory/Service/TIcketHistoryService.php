<?php
namespace TicketHistory\Service;

use TicketHistory\Entity\TicketHistoryEntity;
use TicketHistory\Mapper\TicketHistoryMapperInterface;
use History\Service\HistoryServiceInterface;
use History\Entity\HistoryEntity;

class TIcketHistoryService implements TicketHistoryServiceInterface
{
    /**
     * 
     * @var TicketHistoryMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @var HistoryServiceInterface
     */
    protected $historyService;
    
    /**
     * 
     * @param TicketHistoryMapperInterface $mapper
     * @param HistoryServiceInterface $historyService
     */
    public function __construct(TicketHistoryMapperInterface $mapper, HistoryServiceInterface $historyService)
    {
        $this->mapper = $mapper;
        
        $this->historyService = $historyService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketHistory\Service\TicketHistoryServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketHistory\Service\TicketHistoryServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketHistory\Service\TicketHistoryServiceInterface::save()
     */
    public function save(TicketHistoryEntity $entity)
    {
        return $this->mapper->save($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \TicketHistory\Service\TicketHistoryServiceInterface::create()
     */
    public function create($ticketId, $authId, $historyUrl, $historyAction, $historyNote)
    {
        $entity = new HistoryEntity();
        
        $entity->setAuthId($authId);
        $entity->setHistoryAction($historyAction);
        $entity->setHistoryId(0);
        $entity->setHistoryTime(time());
        $entity->setHistoryUrl($historyUrl);
        $entity->setHistoryNote($historyNote);
        
        $historyEntity = $this->historyService->save($entity);
        
        // create ticket history
        $entity = new TicketHistoryEntity();
        
        $entity->setHistoryId($historyEntity->getHistoryId());
        $entity->setTicketId($ticketId);
        $entity->setTicketHistoryId(0);
        
        $ticketHistoryEntity = $this->save($entity);
        
        return $ticketHistoryEntity;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketHistory\Service\TicketHistoryServiceInterface::delete()
     */
    public function delete(TicketHistoryEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}