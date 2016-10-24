<?php
namespace Log\Service;

interface LogServiceInterface
{
    public function getLogFiles();
    
    public function getLogFolders($folder);
}

?>