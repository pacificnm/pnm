<?php
namespace Application\Mapper;

interface GitHubMapperInterface
{
    public function getIssues();
    
    public function getMilestones();
}

