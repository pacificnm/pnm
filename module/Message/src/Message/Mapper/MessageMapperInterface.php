<?php
namespace Message\Mapper;

use Message\Entity\MessageEntity;

interface MessageMapperInterface
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
     * @param MessageEntity $entity            
     * @return boolean
     */
    public function delete(MessageEntity $entity);
}