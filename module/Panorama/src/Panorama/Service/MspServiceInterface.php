<?php
namespace Panorama\Service;

interface MspServiceInterface
{
    public function getClientsSummary();
    
    public function getClient($id);
    
    public function getClients();
    
    public function createClient($name, $location);
    
    public function updateCLient();
    
    public function deleteClient($id);
    
    public function getCurrentSnoozeStatus();
    
    public function setSnoozePeriod($for);
    
    public function Unsnooze();
    
    public function getAllUsers();
    
    public function getAllTemplates();
    
    
}

?>