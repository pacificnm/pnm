<?php
namespace History\Mapper;

use History\Entity\HistoryEntity;

interface HistoryMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return HistoryEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return HistoryEntity
     */
    public function get($id);

    /**
     *
     * @param HistoryEntity $entity            
     * @return HistoryEntity
     */
    public function save(HistoryEntity $entity);

    /**
     *
     * @param HistoryEntity $entity            
     * @return boolean
     */
    public function delete(HistoryEntity $entity);
}