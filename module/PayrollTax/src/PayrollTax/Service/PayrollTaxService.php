<?php
namespace PayrollTax\Service;

use PayrollTax\Entity\PayrollTaxEntity;
use PayrollTax\Mapper\MysqlMapperInterface;

class PayrollTaxService implements PayrollTaxServiceInterface
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
     * @see \PayrollTax\Service\PayrollTaxServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \PayrollTax\Service\PayrollTaxServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \PayrollTax\Service\PayrollTaxServiceInterface::save()
     */
    public function save(PayrollTaxEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \PayrollTax\Service\PayrollTaxServiceInterface::delete()
     */
    public function delete(PayrollTaxEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

