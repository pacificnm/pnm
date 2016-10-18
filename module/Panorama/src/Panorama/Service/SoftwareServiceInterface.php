<?php
namespace Panorama\Service;

interface SoftwareServiceInterface
{
    public function getSoftware($id);
    
    public function getAllSoftware();
    
    public function getInstallations($id);
}