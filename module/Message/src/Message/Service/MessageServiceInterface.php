<?php
namespace Message\Service;

use Message\Entity\MessageEntity;
use Workorder\Entity\WorkorderEntity;
use Employee\Entity\EmployeeEntity;
use User\Entity\UserEntity;

interface MessageServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return MessageEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return MessageEntity
     */
    public function get($id);

    /**
     *
     * @param MessageEntity $entity            
     * @return MessageEntity
     */
    public function save(MessageEntity $entity);

    /**
     *
     * @param WorkorderEntity $workorderEntity            
     * @param EmployeeEntity $employeeEntity            
     * @return \Message\Entity\MessageEntity
     */
    public function saveEmployeeWorkorder(WorkorderEntity $workorderEntity, EmployeeEntity $employeeEntity);

    /**
     *
     * @param WorkorderEntity $workorderEntity            
     * @param UserEntity $userEntity            
     * @return \Message\Entity\MessageEntity
     */
    public function saveUserWorkorder(WorkorderEntity $workorderEntity, UserEntity $userEntity);

    /**
     *
     * @param MessageEntity $entity            
     * @return boolean
     */
    public function delete(MessageEntity $entity);
}