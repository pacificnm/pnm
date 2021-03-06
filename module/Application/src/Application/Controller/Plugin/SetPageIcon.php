<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;

class SetPageIcon extends AbstractPlugin
{
    /**
     *
     * @var array
     */
    protected $config;
    
    /**
     *
     * @var Zend\View\Renderer\PhpRenderer
     */
    protected $phpRenderer;
    
    /**
     *
     * @param array $config
     * @param PhpRenderer $phpRenderer
     */
    public function __construct(array $config, PhpRenderer $phpRenderer)
    {
        $this->config = $config;
    
        $this->phpRenderer = $phpRenderer;
    
    }
    
    /**
     *
     * @param string $matchedRouteName
     * @param ViewModel $layout
     */
    public function __invoke($matchedRouteName, ViewModel $layout)
    {
        // main menu
        if (array_key_exists('activeMenuItem', $this->config['router']['routes'][$matchedRouteName])) {
    
            if(array_key_exists('pageIcon', $this->config['router']['routes'][$matchedRouteName])) {
                $pageIcon = $this->config['router']['routes'][$matchedRouteName]['pageIcon'];
        
                $layout->setVariable('pageIcon', $pageIcon);
            }
        }
    }
}

