<?php
namespace WorkorderEmail\Mapper;

use WorkorderEmail\Entity\WorkorderEmailEntity;

interface MysqlMapperInterface
{

    public function getAll($filter);

    public function get($id);

    public function save(WorkorderEmailEntity $entity);

    public function delete(WorkorderEmailEntity $entity);
}