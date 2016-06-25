<?php
namespace VendorPayment\Service;

use VendorPayment\Entity\PaymentEntity;
use VendorPayment\Mapper\PaymentMapperInterface;

class PaymentService implements PaymentServiceInterface
{

    /**
     *
     * @var PaymentMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param PaymentMapperInterface $mapper            
     */
    public function __construct(PaymentMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorPayment\Service\PaymentServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorPayment\Service\PaymentServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorPayment\Service\PaymentServiceInterface::save()
     */
    public function save(PaymentEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorPayment\Service\PaymentServiceInterface::delete()
     */
    public function delete(PaymentEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \VendorPayment\Service\PaymentServiceInterface::getVendorBillPayments()
     */
    public function getVendorBillPayments($vendorBillId)
    {
        $filter = array(
          'vendorBillId' => $vendorBillId  
        );
        
        return $this->mapper->getAll($filter);
    }
}