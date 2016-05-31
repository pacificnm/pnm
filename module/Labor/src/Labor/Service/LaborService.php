<?php
namespace Labor\Service;

use Labor\Entity\LaborEntity;
use Labor\Mapper\LaborMapperInterface;

class LaborService implements LaborServiceInterface
{

    /**
     *
     * @var LaborMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param LaborMapperInterface $mapper            
     */
    public function __construct(LaborMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Labor\Service\LaborServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Labor\Service\LaborServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Labor\Service\LaborServiceInterface::save()
     */
    public function save(LaborEntity $laborEntity)
    {
        return $this->mapper->save($laborEntity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Labor\Service\LaborServiceInterface::delete()
     */
    public function delete(LaborEntity $laborEntity)
    {
        return $this->mapper->delete($laborEntity);
    }
}