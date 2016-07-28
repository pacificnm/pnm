<?php
namespace Application\Service;

interface GitHubServiceInterface
{
    public function getIssues();
    
    public function getMilestones();
}

