<?php
namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class AdminAsideMenu extends AbstractHelper
{
    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        
       
    }
    
    /**
     * 
     */
    public function __invoke()
    {
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
    
        $data  = new \stdClass();
        
        $data->config = $this->config;
  
        
        // set partial script
        return $partialHelper('partials/admin-aside-menu.phtml');
    }
}