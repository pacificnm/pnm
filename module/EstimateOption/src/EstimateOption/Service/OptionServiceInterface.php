<?php
namespace EstimateOption\Service;

use EstimateOption\Entity\OptionEntity;

interface OptionServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return OptionEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return OptionEntity
     */
    public function get($id);

    /**
     *
     * @param OptionEntity $entity            
     * @return OptionEntity
     */
    public function save(OptionEntity $entity);

    /**
     *
     * @param OptionEntity $entity            
     * @return boolean
     */
    public function delete(OptionEntity $entity);
    
    /**
     * 
     * @param number $estimateId
     * @return OptionEntity
     */
    public function getEstimateOptions($estimateId);
}