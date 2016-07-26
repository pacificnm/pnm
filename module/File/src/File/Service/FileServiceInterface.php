<?php
namespace File\Service;

use File\Entity\FileEntity;

interface FileServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return FileEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return FileEntity
     */
    public function get($id);

    /**
     *
     * @param FileEntity $entity            
     * @return FileEntity
     */
    public function save(FileEntity $entity);

    /**
     *
     * @param FileEntity $entity            
     * @return boolean
     */
    public function delete(FileEntity $entity);
}

