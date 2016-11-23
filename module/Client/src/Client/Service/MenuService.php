<?php
namespace Client\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;
use Interop\Container\ContainerInterface;

class MenuService extends DefaultNavigationFactory
{
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Navigation\Service\AbstractNavigationFactory::getPages()
     */
    protected function getPages(ContainerInterface $container)
    {
        if (null === $this->pages) {
            $configuration = $container->get('config');
    
            if (! isset($configuration['menu'])) {
                throw new \Exception('Could not find menu configuration key');
            }
    
            if (! isset($configuration['menu'][$this->getName()]['client'])) {
                throw new \Exception(sprintf('Failed to find a menu container by the name "%s"', $this->getName()));
            }
    
            $pages = $this->getPagesFromConfig($configuration['menu'][$this->getName()]['client']);
    
            //\Zend\Debug\Debug::dump($pages);
            
            $this->pages = $this->preparePages($container, $pages);
        }
    
        
        
        
        return $this->pages;
    }
    
   
}