<?php
namespace PanoramaIssue\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use PanoramaIssue\Entity\PanoramaIssueEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param PanoramaIssueEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PanoramaIssueEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('panorama_issue');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('panorama_issue');
        
        $this->select->where(array(
            'panorama_issue.panorama_issue_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Mapper\MysqlMapperInterface::save()
     */
    public function save(PanoramaIssueEntity $entity)
    {
        // if we have id then its an update
        if ($entity->getPanoramaIssueId()) {
            $this->updateIssue($entity);
        } else {
            $this->createIssue($entity);
        }
        
        return $this->get($entity->getPanoramaIssueId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Mapper\MysqlMapperInterface::createIssue()
     */
    public function createIssue(PanoramaIssueEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        $this->insert = new Insert('panorama_issue');
        
        $this->insert->values($postData);
        
        return $entity;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Mapper\MysqlMapperInterface::updateIssue()
     */
    public function updateIssue(PanoramaIssueEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        $this->update = new Update('panorama_issue');
        
        $this->update->set($postData);
        
        $this->update->where(array(
            'panorama_issue.panorama_issue_id = ?' => $entity->getPanoramaIssueId()
        ));
        
        $this->updateRow();
        
        return $entity;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(PanoramaIssueEntity $entity)
    {
        $this->delete = new Delete('panorama_issue');
        
        $this->delete->where(array(
            'panorama_issue.panorama_issue_id = ?' => $entity->getPanoramaIssueId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     */
    protected function filter($filter)
    {
        return $this;
    }
}