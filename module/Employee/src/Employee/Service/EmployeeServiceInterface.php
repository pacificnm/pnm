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

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
interface EmployeeServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return EmployeeEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return EmployeeEntity
     */
    public function get($id);

    /**
     *
     * @param EmployeeEntity $entity            
     * @return EmployeeEntity
     */
    public function save(EmployeeEntity $entity);

    /**
     *
     * @param EmployeeEntity $entity            
     * @return boolean
     */
    public function delete(EmployeeEntity $entity);
}