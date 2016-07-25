<?php
namespace CallLogNote\Service;

use CallLogNote\Entity\NoteEntity;

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
    
    /**
     * 
     * @param number $callLogId
     * @return NoteEntity
     */
    public function getCallLogNotes($callLogId);
}
