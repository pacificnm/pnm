<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Service;

use CallLog\Entity\LogEntity;
use CallLog\Mapper\LogMapperInterface;


class LogService implements LogServiceInterface
{
    /**
     * 
     * @var LogMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param LogMapperInterface $mapper
     */
    public function __construct(LogMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Service\LogServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Service\LogServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Service\LogServiceInterface::getEmployeeCallLogs()
     */
    public function getEmployeeCallLogs($employeeId)
    {
        return $this->mapper->getEmployeeCallLogs($employeeId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Service\LogServiceInterface::save()
     */
    public function save(LogEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Service\LogServiceInterface::delete()
     */
    public function delete(LogEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}
