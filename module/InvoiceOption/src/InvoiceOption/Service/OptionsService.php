<?php
namespace InvoiceOption\Service;

use InvoiceOption\Entity\OptionEntity;
use InvoiceOption\Mapper\OptionMapperInterface;

class OptionsService implements OptionServiceInterface
{

    /**
     *
     * @var OptionMapperInterface
     */
    protected $mapper;

    
    /**
     *
     * @param OptionMapperInterface $mapper            
     */
    public function __construct(OptionMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoiceOption\Service\OptionServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoiceOption\Service\OptionServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoiceOption\Service\OptionServiceInterface::save()
     */
    public function save(OptionEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoiceOption\Service\OptionServiceInterface::delete()
     */
    public function delete(OptionEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}