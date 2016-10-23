<?php
namespace Auth\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Auth\Entity\AuthEntity;
use Application\Mapper\CoreMysqlMapper;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param AuthEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, AuthEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinEmployee()->joinUser();
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::getAuth()
     */
    public function getAuth($authEmail, $authPassword)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinEmployee()->joinUser();
        
        $this->select->where(array(
            'auth.auth_email = ?' => $authEmail
        ));
        
        $this->select->where(array(
            'auth.auth_password = ?' => $authPassword
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::getAuthByEmail()
     */
    public function getAuthByEmail($authEmail)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinEmployee()->joinUser();
        
        $this->select->where(array(
            'auth.auth_email = ?' => $authEmail
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinEmployee()->joinUser();
        
        $this->select->where(array(
            'auth.auth_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::save()
     */
    public function save(AuthEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getAuthId()) {
            $this->update = new Update('auth');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'auth.auth_id = ?' => $entity->getAuthId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('auth');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setAuthId($id);
        }
        
        return $this->get($entity->getAuthId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(AuthEntity $entity)
    {
        $this->delete = new Delete('auth');
        
        $this->delete->where(array(
            'auth.auth_id = ?' => $entity->getAuthId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \Auth\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }

    /**
     *
     * @return \Auth\Mapper\MysqlMapper
     */
    protected function joinUser()
    {
        $this->select->join('user', 'user.user_id = auth.user_id', array(
            'client_id',
            'location_id',
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'left');
        
        return $this;
    }

    /**
     *
     * @return \Auth\Mapper\MysqlMapper
     */
    protected function joinEmployee()
    {
        // join employee
        $this->select->join('employee', 'employee.employee_id = auth.employee_id', array(
            'employee_title',
            'employee_im',
            'employee_image',
            'employee_status'
        ), 'left');
        
        return $this;
    }
}
