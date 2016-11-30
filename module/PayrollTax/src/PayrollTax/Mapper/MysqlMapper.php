<?php
namespace PayrollTax\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use PayrollTax\Entity\PayrollTaxEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param PayrollTaxEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PayrollTaxEntity $prototype)
    {
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    
        parent::__construct($readAdapter, $writeAdapter);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \PayrollTax\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('payroll_tax');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PayrollTax\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('payroll_tax');
        
        $this->select->where(array(
            'payroll_tax_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PayrollTax\Mapper\MysqlMapperInterface::save()
     */
    public function save(PayrollTaxEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getPayrollTaxId()) {
            $this->update = new Update('payroll_tax');
        
            $this->update->set($postData);
        
            $this->update->where(array(
                'payroll_tax.payroll_tax_id = ?' => $entity->getPayrollTaxId()
            ));
        
            $this->updateRow();
        } else {
            $this->insert = new Insert('payroll_tax');
        
            $this->insert->values($postData);
        
            $id = $this->createRow();
        
            $entity->setPayrollTaxId($id);
        }
        
        return $this->get($entity->getPayrollTaxId());
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PayrollTax\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(PayrollTaxEntity $entity)
    {
        $this->delete = new Delete('payroll_tax');
        
        $this->delete->where(array(
            'payroll_tax.payroll_tax_id = ?' => $entity->getPayrollTaxId()
        ));
        
        return $this->deleteRow();
    }
    
    /**
     * 
     * @param array $filter
     * @return \PayrollTax\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}

