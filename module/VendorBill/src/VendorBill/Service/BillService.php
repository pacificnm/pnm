<?php
namespace VendorBill\Service;

use VendorBill\Entity\BillEntity;
use VendorBill\Mapper\BillMapperInterface;

class BillService implements BillServiceInterface
{
    /**
     * 
     * @var BillMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param BillMapperInterface $mapper
     */
    public function __construct(BillMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorBill\Service\BillServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorBill\Service\BillServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorBill\Service\BillServiceInterface::save()
     */
    public function save(BillEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorBill\Service\BillServiceInterface::delete()
     */
    public function delete(BillEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
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