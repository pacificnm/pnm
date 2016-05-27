<?php
namespace Client\Service;

use Client\Entity\ClientEntity;

interface ClientServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return ClientEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return ClientEntity
     */
    public function get($id);

    /**
     *
     * @param ClientEntity $clientEntity            
     * @return ClientEntity
     */
    public function save(ClientEntity $clientEntity);

    /**
     *
     * @param ClientEntity $clientEntity            
     * @return boolean
     */
    public function delete(ClientEntity $clientEntity);
}