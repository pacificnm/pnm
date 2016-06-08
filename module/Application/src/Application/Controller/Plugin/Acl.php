<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use \Zend\Permissions\Acl\Acl;
use \Zend\Permissions\Acl\Role\GenericRole;
use \Zend\Permissions\Acl\Resource\GenericResource;

class Acl extends AbstractPlugin
{

    /**
     *
     * @var \Zend\Permissions\Acl\Acl
     */
    protected $acl;

    /**
     *
     * @var string
     */
    protected $module;

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
     * @param string $module            
     * @throws \Exception
     * @return \Application\Controller\Plugin\Acl
     */
    public function __invoke($module)
    {
        $this->module = $module;
        
        // load config
        if (array_key_exists($this->module, $this->config)) {
            
            // set up acls
            if (array_key_exists('acl', $this->config[$this->module])) {
                $acl = new Acl();
                
                $allResources = array();
                
                $roles = $this->config[$this->module]['acl'];
                
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
                
                return $this;
            } else {
                throw new \Exception('Config is missing acl definition.');
            }
        } else {
            throw new \Exception('Config is missing module definition');
        }
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
}