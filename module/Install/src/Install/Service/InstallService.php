<?php
namespace Install\Service;

use Install\Mapper\InstallMapperInterface;
class InstallService implements InstallServiceInterface
{

    /**
     * 
     * @var InstallMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param InstallMapperInterface $mapper
     */
    public function __construct(InstallMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Install\Service\InstallServiceInterface::installTabel()
     */
    public function installTabel($sql)
    {
        return $this->mapper->installTabel($sql);
    }
}
