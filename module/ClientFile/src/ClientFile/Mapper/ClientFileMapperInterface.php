<?php
namespace ClientFile\Mapper;

use ClientFile\Entity\ClientFileEntity;

interface ClientFileMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return ClientFileEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return ClientFileEntity
     */
    public function get($id);

    /**
     *
     * @param ClientFileEntity $entity            
     * @return ClientFileEntity
     */
    public function save(ClientFileEntity $entity);

    /**
     *
     * @param ClientFileEntity $entity            
     * @return boolean
     */
    public function delete(ClientFileEntity $entity);
    
    /**
     *
     * @param number $clientId
     * @return ClientFileEntity
     */
    public function getClientFiles($clientId);
    
    /**
     *
     * @param number $fileId
     * @param number $clientId
     * @return ClientFileEntity
     */
    public function createClientFile($fileId, $clientId);
}