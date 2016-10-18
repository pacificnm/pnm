<?php
namespace CallLogEmail\Mapper;

use Zend\Stdlib\Hydrator\HydratorInterface;
use Application\Mapper\CoreMysqlMapper;
use CallLogEmail\Entity\CallLogEmailEntity;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param unknown $readAdapter            
     * @param unknown $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param CallLogEmailEntity $prototype            
     */
    public function __construct($readAdapter, $writeAdapter, HydratorInterface $hydrator, CallLogEmailEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filer)
    {
        $this->select = $this->readSql->select('call_log_email');
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('call_log_email');
        
        $this->select->where(array(
            'call_log_email.call_log_email_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Mapper\MysqlMapperInterface::save()
     */
    public function save(\CallLogEmail\Entity\CallLogEmailEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getCallLogEmailId()) {
            $this->update = new Update('call_log_email');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'call_log_email.call_log_email_id = ?' => $entity->getCallLogEmailId()
            ));
            
            $this->updateRow();
            
            return $this->get($entity->getCallLogEmailId());
        } else {
            $this->insert = new Insert('call_log_email');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            return $this->get($id);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(\CallLogEmail\Entity\CallLogEmailEntity $entity)
    {
        $this->delete = new Delete('Call_log_email');
        
        $this->delete->where(array(
            'call_log_email.call_log_email_id = ?' => $entity->getCallLogEmailId()
        ));
        
        return $this->deleteRow();
    }
}