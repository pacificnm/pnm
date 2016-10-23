<?php
namespace Panorama\Service;

interface IssueServiceInterface
{
    public function getIssue($id);
    
    public function getAllIssues($cid);
    
    public function getDeviceIssues($cid, $id);
    
    public function getLatestIssues($hours);
    
    public function getVulnerabilityIssues($cid);
    
    public function getAvailabilityIssues($cid);
    
    public function getComplianceIssues($cid);
    
    public function snoozeIssue($id, $period);
    
    public function patchIssue($id);
}