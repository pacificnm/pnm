<?php
namespace Panorama\Service;

interface DeviceServiceInterface
{
    public function getComputers($cid);
    
    public function getServers($cid);
    
    public function getPrinters($cid);
    
    public function getSwitches($cid);
    
    public function getNas($cid);
    
    public function getUps($cid);
    
    public function getDevices($cid);
    
    public function getDevice($cid,$id);
    
    public function getServices($id);
    
    public function getSystemEvents($id, $period);
    
    public function getUsageData($id, $period);
    
    public function remoteManageService($id);
    
    public function rebootDevice($id);
    
    public function getLocation($cid);
}

?>