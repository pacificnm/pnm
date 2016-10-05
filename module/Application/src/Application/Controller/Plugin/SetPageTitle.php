<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;

class SetPageTitle extends AbstractPlugin
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
     * @return mixed
     */
    public function __invoke($matchedRouteName, $layout)
    {
        if (array_key_exists('title', $this->config['router']['routes'][$matchedRouteName])) {
            $this->phpRenderer->headTitle($this->config['router']['routes'][$matchedRouteName]['title']);
        }
        
        $pageTitle = $this->config['router']['routes'][$matchedRouteName]['title'];
        
        $layout->setVariable('pageTitle', $pageTitle);
        
        return $pageTitle;
    }
    
    
}