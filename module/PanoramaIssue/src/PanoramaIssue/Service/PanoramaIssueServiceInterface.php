<?php
namespace PanoramaIssue\Service;

use PanoramaIssue\Entity\PanoramaIssueEntity;

interface PanoramaIssueServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return PanoramaIssueEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PanoramaIssueEntity
     */
    public function get($id);

    /**
     *
     * @param PanoramaIssueEntity $entity            
     * @return PanoramaIssueEntity
     */
    public function save(PanoramaIssueEntity $entity);

    /**
     *
     * @param PanoramaIssueEntity $entity
     * @return PanoramaIssueEntity
     */
    public function createIssue(PanoramaIssueEntity $entity);
    
    /**
     *
     * @param PanoramaIssueEntity $entity
     * @return PanoramaIssueEntity
     */
    public function updateIssue(PanoramaIssueEntity $entity);
    
    /**
     *
     * @param PanoramaIssueEntity $entity            
     * @return boolean
     */
    public function delete(PanoramaIssueEntity $entity);
}