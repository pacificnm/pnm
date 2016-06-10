<?php
namespace Workorder\Mapper;

use Workorder\Entity\WorkorderEntity;

interface WorkorderMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return WorkorderEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return WorkorderEntity
     */
    public function get($id);

    /**
     *
     * @param number $clientId            
     * @param string $status            
     * @return number
     */
    public function getClientTotalCount($clientId, $status);

    /**
     *
     * @param number $clientId            
     * @return float
     */
    public function getClientTotalLabor($clientId);

    /**
     *
     * @param number $clientId            
     * @return float
     *
     */
    public function getClientTotalPart($clientId);

    /**
     *
     * @param number $clientId            
     * @return WorkorderEntity
     */
    public function getClientUnInvoiced($clientId);

    /**
     * 
     * @param number $invoiceId
     * @return WorkorderEntity
     */
    public function getInvoiceWorkorders($invoiceId);
    
    /**
     *
     * @param WorkorderEntity $entity            
     * @return WorkorderEntity
     */
    public function save(WorkorderEntity $entity);

    /**
     *
     * @param WorkorderEntity $entity            
     * @return boolean
     */
    public function delete(WorkorderEntity $entity);
}