<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Config\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Config\Service\ConfigServiceInterface;

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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