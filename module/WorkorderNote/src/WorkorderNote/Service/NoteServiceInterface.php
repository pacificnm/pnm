<?php
namespace WorkorderNote\Service;

use WorkorderNote\Entity\NoteEntity;

interface NoteServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return NoteEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return NoteEntity
     */
    public function get($id);

    /**
     *
     * @param NoteEntity $entity            
     * @return NoteEntity
     */
    public function save(NoteEntity $entity);

    /**
     *
     * @param NoteEntity $entity            
     * @return boolean
     */
    public function delete(NoteEntity $entity);
}