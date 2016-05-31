<?php
namespace Password\Service;

use Password\Entity\PasswordEntity;
use Password\Mapper\PasswordMapperInterface;

class PasswordService implements PasswordServiceInterface
{

    /**
     *
     * @var PasswordMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param PasswordMapperInterface $mapper            
     */
    public function __construct(PasswordMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Password\Service\PasswordServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Password\Service\PasswordServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Password\Service\PasswordServiceInterface::save()
     */
    public function save(PasswordEntity $passwordEntity)
    {
        return $this->mapper->save($passwordEntity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Password\Service\PasswordServiceInterface::delete()
     */
    public function delete(PasswordEntity $passwordEntity)
    {
        return $this->mapper->delete($passwordEntity);
    }
}