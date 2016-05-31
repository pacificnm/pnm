<?php
namespace Password\Mapper;

use Password\Entity\PasswordEntity;

interface PasswordMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return PasswordEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PasswordEntity
     */
    public function get($id);

    /**
     *
     * @param PasswordEntity $passwordEntity            
     * @return PasswordEntity
     */
    public function save(PasswordEntity $passwordEntity);

    /**
     *
     * @param PasswordEntity $passwordEntity            
     * @return boolean
     */
    public function delete(PasswordEntity $passwordEntity);
}