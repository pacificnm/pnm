<?php
namespace Message\Service;

use Message\Entity\MessageEntity;
use Message\Mapper\MessageMapperInterface;
use Workorder\Entity\WorkorderEntity;
use Employee\Entity\EmployeeEntity;
use User\Entity\UserEntity;

class MessageService implements MessageServiceInterface
{
    /**
     *
     * @var MessageMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MessageMapperInterface $mapper            
     */
    public function __construct(MessageMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Message\Service\MessageServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Message\Service\MessageServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Message\Service\MessageServiceInterface::save()
     */
    public function save(MessageEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Message\Service\MessageServiceInterface::saveEmployeeWorkorder()
     */
    public function saveEmployeeWorkorder(WorkorderEntity $workorderEntity, EmployeeEntity $employeeEntity)
    {
        $entity = new MessageEntity();
        
        $messageBody = "";
        
        $entity->setMessageToEmail($employeeEntity->getEmployeeEmail());
        $entity->setMessageToName($employeeEntity->getEmployeeName());
        $entity->setMessageDate(time());
        $entity->setMessageSubject('New work order created #' . $workorderEntity->getWorkorderId());
        $entity->setMessageBody($messageBody);
        
        $entity = $this->save($entity);
        
        return $entity;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Message\Service\MessageServiceInterface::saveUserWorkorder()
     */
    public function saveUserWorkorder(WorkorderEntity $workorderEntity, UserEntity $userEntity)
    {
        $entity = new MessageEntity();
        
        $messageBody = "";
        
        $entity->setMessageToEmail($userEntity->getUserEmail());
        $entity->setMessageToName($userEntity->getUserNameFirst() . ' ' . $userEntity->getUserNameLast());
        $entity->setMessageDate(time());
        $entity->setMessageSubject('New work order created #' . $workorderEntity->getWorkorderId());
        $entity->setMessageBody($messageBody);
        
        $entity = $this->save($entity);
        
        return $entity;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Message\Service\MessageServiceInterface::delete()
     */
    public function delete(MessageEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}
