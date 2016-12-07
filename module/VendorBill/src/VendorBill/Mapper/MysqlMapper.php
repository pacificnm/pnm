<?php
namespace VendorBill\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Application\Mapper\CoreMysqlMapper;
use VendorBill\Entity\BillEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ReportProfitEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, BillEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \VendorBill\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('vendor_bill');
        
        $this->filter($filter);
        
        $this->joinVendor();
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \VendorBill\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('vendor_bill');
        
        $this->select->where(array(
            'vendor_bill.vendor_bill_id = ?' => $id
        ));
        
        $this->joinVendor();
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \VendorBill\Mapper\MysqlMapperInterface::getDueBills()
     */
    public function getDueBills()
    {
        $this->select = $this->readSql->select('vendor_bill');
        
        $this->select->where(array(
            'vendor_bill.vendor_bill_status = ?' => 'Un-Paid'
        ));
        
        $this->joinVendor();
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \VendorBill\Mapper\MysqlMapperInterface::getTotalForMonth()
     */
    public function getTotalForMonth($start, $end)
    {
        $this->select = $this->readSql->select('vendor_bill');
        
        $this->select->columns(array(
            'vendor_bill_total' => new \Zend\Db\Sql\Expression('SUM(vendor_bill_amount)')
        ));
        
        $this->select->where->greaterThanOrEqualTo('vendor_bill_date_paid', $start);
        
        $this->select->where->lessThanOrEqualTo('vendor_bill_date_paid', $end);
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $row = $resultSet->current();
            
            if(! $row['vendor_bill_total']) {
                return 0;
            } else {
                return $row['vendor_bill_total'];
            }
            
        }
        
        return 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \VendorBill\Mapper\MysqlMapperInterface::save()
     */
    public function save(BillEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getVendorBillId()) {
            $this->update = new Update('vendor_bill');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'vendor_bill.vendor_bill_id = ?' => $entity->getVendorBillId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('vendor_bill');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setVendorBillId($id);
        }
        
        return $this->get($entity->getVendorBillId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \VendorBill\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(BillEntity $entity)
    {
        $this->delete = new Delete('vendor_bill');
        
        $this->delete->where(array(
            'vendor_bill.vendor_bill_id = ?' => $entity->getVendorBillId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param unknown $filter            
     * @return \VendorBill\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        // vendor
        if (array_key_exists('vendorId', $filter) && ! empty($filter['vendorId'])) {
            $this->select->where(array(
                'vendor_bill.vendor_id = ?' => $filter['vendorId']
            ));
        }
        
        // status
        if (array_key_exists('vendorBillStatus', $filter) && ! empty($filter['vendorBillStatus'])) {
            $this->select->where(array(
                'vendor_bill.vendor_bill_status = ?' => $filter['vendorBillStatus']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @return \VendorBill\Mapper\MysqlMapper
     */
    protected function joinVendor()
    {
        $this->select->join('vendor', 'vendor_bill.vendor_id = vendor.vendor_id', array(
            'vendor_name',
            'vendor_active'
        ), 'left');
        
        return $this;
    }
}

