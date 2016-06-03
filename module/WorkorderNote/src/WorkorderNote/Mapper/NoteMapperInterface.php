<?php
namespace WorkorderNote\Mapper;


use WorkorderNote\Entity\NoteEntity;

interface NoteMapperInterface
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