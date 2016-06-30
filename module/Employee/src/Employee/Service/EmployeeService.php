<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Service;

use Employee\Entity\EmployeeEntity;
use Employee\Mapper\EmployeeMapperInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class EmployeeService implements EmployeeServiceInterface
{
    /**
     * 
     * @var EmployeeMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param EmployeeMapperInterface $mapper
     */
    public function __construct(EmployeeMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::save()
     */
    public function save(EmployeeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::delete()
     */
    public function delete(EmployeeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}