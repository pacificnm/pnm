<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use \Zend\Permissions\Acl\Acl;
use \Zend\Permissions\Acl\Role\GenericRole;
use \Zend\Permissions\Acl\Resource\GenericResource;
use Auth\Entity\AuthEntity;

class BaseController extends AbstractActionController
{
    /**
     *
     * @var Acl
     */
    protected $acl;
    
    /**
     * 
     * @var unknown
     */
    protected $viewModel;
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::onDispatch()
     */
    public function onDispatch(MvcEvent $e)
    {
        $router = $e->getRouteMatch();

        $controller = $router->getParam('controller');
    
        $moduleArray = explode('\\', $controller);
    
        $module = $moduleArray[0];
    
        $serviceLocator = $this->getServiceLocator();
    
        $config = $serviceLocator->get('Config');
        
        // check if we have an identity
        if (! $this->identity() || ! $this->identity() instanceof AuthEntity) {
            return $this->redirect()->toRoute('auth-sign-in', array(), array(
                'query' => array(
                    'from' => $router->getMatchedRouteName()
                )
            ));
        }
    
        // set menu
        $this->layout()->activeSubMenuItem = $router->getMatchedRouteName();
        
        $this->layout()->activeMenuItem = strtolower($module);
        
        // set page title from config
        if(array_key_exists('title', $config['router']['routes'][$router->getMatchedRouteName()])) {
            $this->setHeadTitle($config['router']['routes'][$router->getMatchedRouteName()]['title']);
        }
        
        // load config
        if (array_key_exists($module, $config)) {
    
            // set up acls
            if (array_key_exists('acl', $config[$module])) {
                $acl = new Acl();
    
                $allResources = array();
    
                $roles = $config[$module]['acl'];
        
                // loop though roles and create resources
                foreach ($roles as $role => $resources) {
                    // add roles
                    $role = new GenericRole($role);
    
                    $acl->addRole($role);
    
                    $allResources = array_merge($resources, $allResources);
    
                    foreach ($resources as $resource) {
                        if (! $acl->hasResource($resource)) {
                            $acl->addResource(new GenericResource($resource));
                        }
                    }
    
                    // add restrictions
                    foreach ($allResources as $resource) {
                        $acl->allow($role, $resource);
                    }
                }
    
                $this->acl = $acl;
    
                $this->layout()->acl = $acl;
                
                // check if we are allowed to view the controller
                if (! $this->checkAcl($this->identity()->getAuthRole(), $router->getMatchedRouteName())) {
                    return $this->redirect()
                    ->toRoute()
                    ->setStatusCode(403);
                }
            } else {
                throw new \Exception('Config is missing acl definition.');
            }
        } else {
            throw new \Exception('Config is missing module definition');
        }
    
        // load db config
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $configEntity = $configService->get(1);
        
        $this->layout()->setVariable('configEntity', $configEntity);
        
        $this->configEntity = $configEntity;
        
        // return parent dispatch
        return parent::onDispatch($e);
    }
    
    /**
     *
     * @param string $role
     * @param string $route
     * @return boolean
     */
    public function checkAcl($role, $route)
    {
        if ($this->acl->isAllowed($role, $route)) {
            return true;
        }
    
        return false;
    }
    
    /**
     * 
     * @param string $title
     */
    protected function setHeadTitle($title = '')
    {
        if(!empty($title)){
            $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
            
            $renderer->headTitle($title);
        }
    }
}