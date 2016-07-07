<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderEmployee\Service;

use WorkorderEmployee\Entity\WorkorderEmployeeEntity;
use WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class WorkorderEmployeeService implements WorkorderEmployeeServiceInterface
{

    /**
     *
     * @var WorkorderEmployeeMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param WorkorderEmployeeMapperInterface $mapper            
     */
    public function __construct(WorkorderEmployeeMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderEmployee\Service\WorkorderEmployeeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderEmployee\Service\WorkorderEmployeeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderEmployee\Service\WorkorderEmployeeServiceInterface::save()
     */
    public function save(WorkorderEmployeeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderEmployee\Service\WorkorderEmployeeServiceInterface::delete()
     */
    public function delete(WorkorderEmployeeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderEmployee\Service\WorkorderEmployeeServiceInterface::getEmployeeWorkorders()
     */
    public function getEmployeeWorkorders($employeeId, $status = 'Active')
    {
        return $this->mapper->getEmployeeWorkorders($employeeId, $status);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderEmployee\Service\WorkorderEmployeeServiceInterface::getEmployeeWorkorder()
     */
    public function getEmployeeWorkorder($employeeId, $workorderId)
    {
        return $this->mapper->getEmployeeWorkorder($employeeId, $workorderId);
    }
}