<?php
namespace CallLogNote\V1\Rest\CallLogNote;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use CallLogNote\Service\NoteServiceInterface;
use CallLogNote\Hydrator\NoteHydrator;
use CallLogNote\Entity\NoteEntity;

class CallLogNoteResource extends AbstractResourceListener
{

    /**
     *
     * @var NoteServiceInterface
     */
    protected $noteService;

    /**
     *
     * @param NoteServiceInterface $noteService            
     */
    public function __construct(NoteServiceInterface $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     * Create a resource
     *
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $hydrator = new NoteHydrator();
        
        $entity = $hydrator->hydrate($data, new NoteEntity());
        
        $noteEntity = $this->noteService->save($entity);
        
        return $noteEntity;
    }

    /**
     * Delete a resource
     *
     * @param mixed $id            
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $noteEntity = $this->noteService->get($id);
        
        return $this->noteService->delete($noteEntity);
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param mixed $id            
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->noteService->get($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param array $params            
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->noteService->getAll($params);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param mixed $id            
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param mixed $id            
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $hydrator = new NoteHydrator();
        
        $entity = $hydrator->hydrate($data, new NoteEntity());
        
        $entity->setCallLogNoteId($id);
        
        $noteEntity = $this->noteService->save($entity);
        
        return $noteEntity;
    }
}
