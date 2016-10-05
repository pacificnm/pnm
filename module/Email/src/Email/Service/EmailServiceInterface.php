<?php
namespace Email\Service;

use Email\Entity\EmailEntity;

interface EmailServiceInterface
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
    
    /**
     * 
     * @param EmailEntity $entity
     */
    public function send(EmailEntity $entity);
}