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
     * @param string $clientName            
     * @return ClientEntity
     */
    public function getClientByName($clientName);

    /**
     *
     * @param ClientEntity $entity            
     * @return ClientEntity
     */
    public function save(ClientEntity $entity);

    /**
     *
     * @param string $clientName            
     * @param string $clientStatus            
     * @return ClientEntity
     */
    public function createClient($clientName, $clientStatus);

    /**
     *
     * @param ClientEntity $entity            
     * @return boolean
     */
    public function delete(ClientEntity $entity);
}