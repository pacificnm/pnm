<?php
namespace Panorama\Service;

interface UserServiceInterface
{
    public function getUser($id);
    
    public function getUsers();
}

?>