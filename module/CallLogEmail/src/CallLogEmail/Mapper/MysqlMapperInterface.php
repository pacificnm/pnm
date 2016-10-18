<?php
namespace CallLogEmail\Mapper;

use CallLogEmail\Entity\CallLogEmailEntity;

interface MysqlMapperInterface
{

    public function getAll($filter);

    public function get($id);

    public function save(CallLogEmailEntity $entity);

    public function delete(CallLogEmailEntity $entity);
}