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
     * @return CronEntity
     */
    public function getRunOnce();
    
    /**
     *
     * @param number $minute <minute>
     * @param number $hour <hour>
     * @param number $day <day>
     * @param number $mon  <month>
     * @param number $dow <day of week>
     *
     * @return CronEntity
     */
    public function getByTime($minute, $hour, $day, $mon, $dow);
    
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