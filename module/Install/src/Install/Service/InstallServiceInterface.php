<?php
namespace Install\Service;

interface InstallServiceInterface
{
    /**
     * 
     * @param string $sql
     */
    public function installTabel($sql);
}