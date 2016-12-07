<?php
namespace ReportProfit\Mapper;

use ReportProfit\Entity\ReportProfitEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return ReportProfitEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return ReportProfitEntity
     */
    public function get($id);

    /**
     *
     * @param number $year            
     * @return ReportProfitEntity
     */
    public function getYear($year);

    /**
     *
     * @param number $month            
     * @param number $year            
     */
    public function getMonth($month, $year);

    /**
     *
     * @param ReportProfitEntity $entity            
     * @return ReportProfitEntity
     */
    public function save(ReportProfitEntity $entity);

    /**
     *
     * @param ReportProfitEntity $entity            
     * @return boolean
     */
    public function delete(ReportProfitEntity $entity);
}

