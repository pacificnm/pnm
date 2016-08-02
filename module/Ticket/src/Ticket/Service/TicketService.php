<?php
namespace Ticket\Service;

use Ticket\Mapper\MysqlMapperInterface;

class TicketService implements TicketServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
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
     * @see \Ticket\Service\TicketServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Ticket\Service\TicketServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Ticket\Service\TicketServiceInterface::save()
     */
    public function save(\Ticket\Entity\TicketEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Ticket\Service\TicketServiceInterface::delete()
     */
    public function delete(\Ticket\Entity\TicketEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

