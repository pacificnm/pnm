<?php
namespace Workorder\Service;

use Workorder\Entity\WorkorderEntity;

interface WorkorderServiceInterface
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
     * @param WorkorderEntity $workorderEntity            
     * @return WorkorderEntity
     */
    public function save(WorkorderEntity $workorderEntity);

    /**
     *
     * @param WorkorderEntity $workorderEntity            
     * @return boolean
     */
    public function delete(WorkorderEntity $workorderEntity);
    
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
     */
    public function getClientTotalPart($clientId);
}