<?php
namespace WorkorderEmail\Service;

use WorkorderEmail\Entity\WorkorderEmailEntity;

interface WorkorderEmailServiceInterface
{

    public function getAll($filter);

    public function get($id);

    public function save(WorkorderEmailEntity $entity);

    public function delete(WorkorderEmailEntity $entity);
}
