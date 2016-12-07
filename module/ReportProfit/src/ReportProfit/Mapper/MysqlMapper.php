<?php
namespace ReportProfit\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use ReportProfit\Entity\ReportProfitEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ReportProfitEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ReportProfitEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('report_profit');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('report_profit');
        
        $this->select->where(array(
            'report_profit.report_profit_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Mapper\MysqlMapperInterface::getYear()
     */
    public function getYear($year)
    {
        $this->select = $this->readSql->select('report_profit');
        
        $this->select->where(array(
            'report_profit.report_profit_year = ?' => $year
        ));
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Mapper\MysqlMapperInterface::getMonth()
     */
    public function getMonth($month, $year)
    {
        $this->select = $this->readSql->select('report_profit');
        
        $this->select->where(array(
            'report_profit.report_profit_year = ?' => $year
        ));
        
        $this->select->where(array(
            'report_profit.report_profit_month = ?' => $month
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Mapper\MysqlMapperInterface::save()
     */
    public function save(ReportProfitEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getReportProfitId()) {
            $this->update = new Update('report_profit');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'report_profit.report_profit_id = ?' => $entity->getReportProfitId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('report_profit');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setReportProfitId($id);
        }
        
        return $this->get($entity->getReportProfitId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \ReportProfit\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(ReportProfitEntity $entity)
    {
        $this->delete = new Delete('report_profit');
        
        $this->delete->where(array(
            'report_profit.report_profit_id = ?' => $entity->getReportProfitId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \ReportProfit\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}

