<?php
namespace VendorBill\Service;

use VendorBill\Entity\BillEntity;
use VendorBill\Mapper\MysqlMapperInterface;

class BillService implements BillServiceInterface
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
     * {@inheritDoc}
     *
     * @see \VendorBill\Service\BillServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorBill\Service\BillServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorBill\Service\BillServiceInterface::getDueBills()
     */
    public function getDueBills()
    {
        return $this->mapper->getDueBills();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorBill\Service\BillServiceInterface::getTotalForMonth()
     */
    public function getTotalForMonth($start, $end)
    {
        return $this->mapper->getTotalForMonth($start, $end);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorBill\Service\BillServiceInterface::save()
     */
    public function save(BillEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorBill\Service\BillServiceInterface::delete()
     */
    public function delete(BillEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorBill\Service\BillServiceInterface::getUnpaidBills()
     */
    public function getUnpaidBills()
    {
        $filter = array(
            'vendorBillStatus' => 'Un-Paid'
        );
        
        return $this->mapper->getAll($filter);
    }
}