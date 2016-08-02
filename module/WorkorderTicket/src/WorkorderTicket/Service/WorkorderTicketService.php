<?php
namespace WorkorderTicket\Service;

use WorkorderTicket\Entity\WorkorderTicketEntity;
use WorkorderTicket\Mapper\MysqlMapperInterface;

class WorkorderTicketService implements WorkorderTicketServiceInterface
{

    /**
     *
     * @var unknown
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Service\WorkorderTicketServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Service\WorkorderTicketServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Service\WorkorderTicketServiceInterface::save()
     */
    public function save(WorkorderTicketEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderTicket\Service\WorkorderTicketServiceInterface::delete()
     */
    public function delete(WorkorderTicketEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

