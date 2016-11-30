<?php
namespace Payroll\Service;

use Payroll\Entity\PayrollEntity;
use Payroll\Mapper\MysqlMapperInterface;

class PayrollService implements PayrollServiceInterface
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
     * @see \Payroll\Service\PayrollServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::getYtdFederalIncomeTax()
     */
    public function getYtdFederalIncomeTax($employeeId, $year)
    {
        return $this->mapper->getYtdFederalIncomeTax($employeeId, $year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::getYtdSocialSecurityTax()
     */
    public function getYtdSocialSecurityTax($employeeId, $year)
    {
        return $this->mapper->getYtdSocialSecurityTax($employeeId, $year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::getYtdMedicareTax()
     */
    public function getYtdMedicareTax($employeeId, $year)
    {
        return $this->mapper->getYtdMedicareTax($employeeId, $year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::getYtdStateTax()
     */
    public function getYtdStateTax($employeeId, $year)
    {
        return $this->mapper->getYtdStateTax($employeeId, $year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::getYtdGross()
     */
    public function getYtdGross($employeeId, $year)
    {
        return $this->mapper->getYtdGross($employeeId, $year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::getYtdNet()
     */
    public function getYtdNet($employeeId, $year)
    {
        return $this->mapper->getYtdNet($employeeId, $year);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::save()
     */
    public function save(PayrollEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Service\PayrollServiceInterface::delete()
     */
    public function delete(PayrollEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}