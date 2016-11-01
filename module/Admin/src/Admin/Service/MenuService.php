<?php
namespace Admin\Service;

use Interop\Container\ContainerInterface;

class MenuService extends \Zend\Navigation\Service\DefaultNavigationFactory
{

    /**
     *
     * @param ContainerInterface $container            
     * @return array
     * @throws \Zend\Navigation\Exception\InvalidArgumentException
     */
    protected function getPages(ContainerInterface $container)
    {
        if (null === $this->pages) {
            $configuration = $container->get('config');
            
            if (! isset($configuration['menu'])) {
                throw new \Exception('Could not find menu configuration key');
            }
            
            if (! isset($configuration['menu'][$this->getName()]['admin'])) {
                throw new \Exception(sprintf('Failed to find a menu container by the name "%s"', $this->getName()));
            }
            
            $pages = $this->getPagesFromConfig($configuration['menu'][$this->getName()]['admin']);
            
            $this->pages = $this->preparePages($container, $pages);
        }
        
        return $this->pages;
    }
}