<?php
namespace WorkorderFile\Mapper;

use WorkorderFile\Entity\WorkorderFileEntity;

interface WorkorderFileMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return WorkorderFileEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return WorkorderFileEntity
     */
    public function getWorkorderFiles($workorderId);

    /**
     *
     * @param number $id            
     * @return WorkorderFileEntity
     */
    public function get($id);

    /**
     *
     * @param WorkorderFileEntity $entity            
     * @return WorkorderFileEntity
     */
    public function save(WorkorderFileEntity $entity);

    /**
     *
     * @param WorkorderFileEntity $entity            
     * @return boolean
     */
    public function delete(WorkorderFileEntity $entity);
    
    /**
     *
     * @param number $fileId
     * @return boolean
     */
    public function deleteWorkorderFile($fileId);
}

