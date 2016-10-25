<?php
namespace PanoramaIssue\Service;

use PanoramaIssue\Entity\PanoramaIssueEntity;
use PanoramaIssue\Mapper\MysqlMapperInterface;

class PanoramaIssueService implements PanoramaIssueServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Service\PanoramaIssueServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Service\PanoramaIssueServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Service\PanoramaIssueServiceInterface::save()
     */
    public function save(PanoramaIssueEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Service\PanoramaIssueServiceInterface::createIssue()
     */
    public function createIssue(PanoramaIssueEntity $entity)
    {
        return $this->mapper->createIssue($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Service\PanoramaIssueServiceInterface::updateIssue()
     */
    public function updateIssue(PanoramaIssueEntity $entity)
    {
        return $this->mapper->updateIssue($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaIssue\Service\PanoramaIssueServiceInterface::delete()
     */
    public function delete(PanoramaIssueEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}