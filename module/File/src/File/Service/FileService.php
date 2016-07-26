<?php
namespace File\Service;

use File\Entity\FileEntity;
use File\Mapper\FileMapperInterface;

class FileService implements FileServiceInterface
{

    /**
     *
     * @var FileMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param FileMapperInterface $mapper            
     */
    public function __construct(FileMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \File\Service\FileServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \File\Service\FileServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \File\Service\FileServiceInterface::save()
     */
    public function save(FileEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \File\Service\FileServiceInterface::delete()
     */
    public function delete(FileEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

