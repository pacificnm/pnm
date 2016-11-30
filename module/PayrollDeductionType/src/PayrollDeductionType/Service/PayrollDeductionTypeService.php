<?php
namespace PayrollDeductionType\Service;

use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;
use PayrollDeductionType\Mapper\MysqlMapperInterface;

class PayrollDeductionTypeService implements PayrollDeductionTypeServiceInterface
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
     * @see \PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface::save()
     */
    public function save(PayrollDeductionTypeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface::delete()
     */
    public function delete(PayrollDeductionTypeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}