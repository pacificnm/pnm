<?php
namespace Cron\Service;

use Cron\Entity\CronEntity;
interface CronServiceInterface
{
    /**
     *
     * @param array $filter
     * @return CronEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return CronEntity
     */
    public function get($id);
    
    /**
     *
     * @param CronEntity $entity
     * @return CronEntity
     */
    public function save(CronEntity $entity);
    
    /**
     *
     * @param CronEntity $entity
     * @return bool
     */
    public function delete(CronEntity $entity);
}