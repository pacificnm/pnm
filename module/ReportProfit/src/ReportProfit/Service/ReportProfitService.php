<?php
namespace ReportProfit\Service;

use ReportProfit\Entity\ReportProfitEntity;
use ReportProfit\Mapper\MysqlMapperInterface;

class ReportProfitService implements ReportProfitServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Service\ReportProfitServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Service\ReportProfitServiceInterface::getYear()
     */
    public function getYear($year)
    {
        return $this->mapper->getYear($year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Service\ReportProfitServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Service\ReportProfitServiceInterface::getMonth()
     */
    public function getMonth($month, $year)
    {
        return $this->mapper->getMonth($month, $year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Service\ReportProfitServiceInterface::save()
     */
    public function save(ReportProfitEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Service\ReportProfitServiceInterface::delete()
     */
    public function delete(ReportProfitEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

