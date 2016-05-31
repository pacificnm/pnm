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
}