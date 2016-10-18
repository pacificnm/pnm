<?php
namespace Email\Mapper;

use Email\Entity\EmailEntity;

interface EmailMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return EmailEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return EmailEntity
     */
    public function get($id);

    /**
     *
     * @param EmailEntity $entity            
     * @return EmailEntity
     */
    public function save(EmailEntity $entity);

    /**
     *
     * @param EmailEntity $entity            
     * @return boolean
     */
    public function delete(EmailEntity $entity);
}