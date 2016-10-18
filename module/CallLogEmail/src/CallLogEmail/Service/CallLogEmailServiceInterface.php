<?php
namespace CallLogEmail\Service;

use CallLogEmail\Entity\CallLogEmailEntity;
use CallLog\Entity\LogEntity;

interface CallLogEmailServiceInterface
{

    public function getAll($filter);

    public function get($id);

    public function save(CallLogEmailEntity $entity);

    public function delete(CallLogEmailEntity $entity);
    
    public function mapEmail($callLogId, $emailId);
    
    public function sendCallLogEmail(LogEntity $logEntity);
}