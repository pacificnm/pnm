<?php
namespace WorkorderCredit\Service;

use WorkorderCredit\Entity\CreditEntity;
interface CreditServiceInterface
{
    /**
     *
     * @param array $filter
     * @return CreditEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return CreditEntity
     */
    public function get($id);
    
    /**
     *
     * @param CreditEntity $entity
     * @return CreditEntity
     */
    public function save(CreditEntity $entity);
    
    /**
     *
     * @param CreditEntity $entity
     * @return boolean
     */
    public function delete(CreditEntity $entity);
    
    /**
     *
     * @param number $workorderId
     * @return float
     */
    public function getWorkorderTotal($workorderId);
    
    /**
     * 
     * @param number $workorderId
     * @return CreditEntity
     */
    public function getWorkorderCredit($workorderId);
    
    /**
     *
     * @param number $clientId
     * @return CreditEntity
     */
    public function getWorkorderCreditBalance($clientId);
    
    /**
     *
     * @param number $workorderId
     * @return CreditEntity
     */
    public function getWorkorderLaborCredit($workorderId);
    
    /**
     *
     * @param number $workorderId
     * @return CreditEntity
     */
    public function getWorkorderPartCredit($workorderId);
    
}