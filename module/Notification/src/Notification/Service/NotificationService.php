<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Notification\Service;

use Notification\Entity\NotificationEntity;
use Notification\Mapper\NotificationMapperInterface;


class NotificationService implements NotificationServiceInterface
{

    /**
     * 
     * @var NotificationMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param NotificationMapperInterface $mapper
     */
    public function __construct(NotificationMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Service\NotificationServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Service\NotificationServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Service\NotificationServiceInterface::save()
     */
    public function save(NotificationEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Service\NotificationServiceInterface::delete()
     */
    public function delete(NotificationEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}
