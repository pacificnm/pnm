<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * 
 * @author jaimie
 *
 */
class AccountAsideMenu extends AbstractHelper
{

    /**
     * 
     */
    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        // set partial script
        return $partialHelper('partials/account-aside-menu');
    }
}