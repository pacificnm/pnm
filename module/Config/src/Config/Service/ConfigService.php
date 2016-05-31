<?php
namespace Config\Service;

use Config\Entity\ConfigEntity;
use Config\Mapper\ConfigMapperInterface;

class ConfigService implements ConfigServiceInterface
{

    /**
     * 
     * @var ConfigMapperInterface
     */
    protected $mapper;

    /**
     * 
     * @param ConfigMapperInterface $mapper
     */
    public function __construct(ConfigMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Config\Service\ConfigServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Config\Service\ConfigServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Config\Service\ConfigServiceInterface::save()
     */
    public function save(ConfigEntity $configEntity)
    {
        return $this->mapper->save($configEntity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Config\Service\ConfigServiceInterface::delete()
     */
    public function delete(ConfigEntity $configEntity)
    {
        return $this->mapper->delete($configEntity);
    }
}