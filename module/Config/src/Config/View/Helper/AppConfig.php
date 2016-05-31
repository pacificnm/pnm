<?php
namespace Config\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Config\Service\ConfigServiceInterface;

class AppConfig extends AbstractHelper
{
    /**
     * 
     * @var unknown
     */
    protected $configService;
    
    /**
     * 
     * @param ConfigServiceInterface $configService
     */
    public function __construct(ConfigServiceInterface $configService)
    {
        $this->configService = $configService;
    }
    
    /**
     * 
     * @return \Config\Entity\ConfigEntity
     */
    public function __invoke()
    {
        return $this->configService->get(1);
    }
}