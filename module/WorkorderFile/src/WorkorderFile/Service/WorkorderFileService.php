<?php
namespace WorkorderFile\Service;

use WorkorderFile\Entity\WorkorderFileEntity;
use WorkorderFile\Mapper\WorkorderFileMapperInterface;

class WorkorderFileService implements WorkorderFileServiceInterface
{

    /**
     *
     * @var WorkorderFileMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param WorkorderFileMapperInterface $mapper            
     */
    public function __construct(WorkorderFileMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Service\WorkorderFileServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Service\WorkorderFileServiceInterface::getWorkorderFiles()
     */
    public function getWorkorderFiles($workorderId)
    {
        return $this->mapper->getWorkorderFiles($workorderId);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Service\WorkorderFileServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Service\WorkorderFileServiceInterface::save()
     */
    public function save(WorkorderFileEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    public function createWorkorderFile($fileId, $workorderId)
    {
        $entity = new WorkorderFileEntity();
        
        $entity->setFileId($fileId);
        
        $entity->setWorkorderId($workorderId);
        
        $workorderFileEntity = $this->mapper->save($entity);
        
        return $workorderFileEntity;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Service\WorkorderFileServiceInterface::delete()
     */
    public function delete(WorkorderFileEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderFile\Service\WorkorderFileServiceInterface::deleteWorkorderFile()
     */
    public function deleteWorkorderFile($fileId)
    {
        return $this->mapper->deleteWorkorderFile($fileId);
    }
}

