<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Notification\Mapper;

use Notification\Entity\NotificationEntity;

interface NotificationMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return NotificationEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return NotificationEntity
     */
    public function get($id);

    /**
     *
     * @param NotificationEntity $entity            
     * @return NotificationEntity
     */
    public function save(NotificationEntity $entity);

    /**
     *
     * @param NotificationEntity $entity            
     * @return boolean
     */
    public function delete(NotificationEntity $entity);
}
