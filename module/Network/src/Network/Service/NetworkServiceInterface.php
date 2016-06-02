<?php
namespace Network\Service;

use Network\Entity\NetworkEntity;

interface NetworkServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return NetworkEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return NetworkEntity
     */
    public function get($id);

    /**
     *
     * @param NetworkEntity $entity            
     * @return NetworkEntity
     */
    public function save(NetworkEntity $entity);

    /**
     *
     * @param NetworkEntity $entity            
     * @return NetworkEntity
     */
    public function delete(NetworkEntity $entity);
}