<?php
namespace Application\Service;

use Application\Mapper\GitHubMapperInterface;

class GitHubService implements GitHubServiceInterface
{

    /**
     *
     * @var GitHubMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param GitHubMapperInterface $mapper            
     */
    public function __construct(GitHubMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Application\Service\GitHubServiceInterface::getIssues()
     */
    public function getIssues()
    {
        return $this->mapper->getIssues();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Application\Service\GitHubServiceInterface::getMilestones()
     */
    public function getMilestones()
    {
        return $this->mapper->getMilestones();
    }
}

