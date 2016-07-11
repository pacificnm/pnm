<?php
namespace EstimateOption\Service;

use EstimateOption\Entity\OptionEntity;
use EstimateOption\Mapper\OptionMapperInterface;


class OptionService implements OptionServiceInterface
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
     * @see \EstimateOption\Service\OptionServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \EstimateOption\Service\OptionServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \EstimateOption\Service\OptionServiceInterface::save()
     */
    public function save(OptionEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \EstimateOption\Service\OptionServiceInterface::delete()
     */
    public function delete(OptionEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \EstimateOption\Service\OptionServiceInterface::getEstimateOptions()
     */
    public function getEstimateOptions($estimateId)
    {
        $filter = array(
            'estimateId' => $estimateId
        );
    
        return $this->mapper->getAll($filter);
    }
}