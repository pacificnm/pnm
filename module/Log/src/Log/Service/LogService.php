<?php
namespace Log\Service;

class LogService implements LogServiceInterface
{
    public function getLogFiles()
    {
        // load top level folders
        $dirs = new \DirectoryIterator('./data/log/');
        
        return $dirs;
    }
    
    public function getLogFolders($folder)
    {
        $files = new \DirectoryIterator('./data/log/' . $folder);
        
        return $files;
    }
}

?>