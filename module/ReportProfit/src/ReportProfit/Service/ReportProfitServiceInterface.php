<?php
namespace ReportProfit\Service;

use ReportProfit\Entity\ReportProfitEntity;

interface ReportProfitServiceInterface
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
     * @return ReportProfitEntity
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

