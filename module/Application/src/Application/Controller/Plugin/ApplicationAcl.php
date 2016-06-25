<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;
use Acl\Service\AclServiceInterface;
use AclRole\Service\RoleServiceInterface;
use AclResource\Service\ResourceServiceInterface;

class ApplicationAcl extends AbstractPlugin
{

    /**
     * 
     * @var AclServiceInterface
     */
    protected $aclService;
    
    /**
     * 
     * @var RoleServiceInterface
     */
    protected $roleService;
    
    /**
     * 
     * @var ResourceServiceInterface
     */
    protected $resourceService;
    
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
     * @param AclServiceInterface $aclService
     * @param RoleServiceInterface $roleService
     * @param ResourceServiceInterface $resourceService
     * @param array $config
     */
    public function __construct(AclServiceInterface $aclService, RoleServiceInterface $roleService, ResourceServiceInterface $resourceService)
    {
        $this->acl = new Acl();

        $this->aclService = $aclService;
        
        $this->roleService = $roleService;
        
        $this->resourceService = $resourceService;
    }

    /**
     *
     * @param string $module            
     * @throws \Exception
     * @return \Application\Controller\Plugin\Acl
     */
    public function __invoke()
    {
        
        // add roles
        $roles = $this->roleService->getAll(array('pagination' => 'off'));
        
        foreach($roles as $role) {
            if(! $this->acl->hasRole($role->getAclRole())) {
                $role = new GenericRole($role->getAclRole());
        
                $this->acl->addRole($role);
            }
        }
        
        // add resources
        $resources = $this->resourceService->getAll(array('pagination' => 'off'));
        
        foreach($resources as $resource) {
            if (! $this->acl->hasResource($resource->getAclResource())) {
                $this->acl->addResource(new GenericResource($resource->getAclResource()));
            }
        }
        
        // add rules
        $rules = $this->aclService->getAll(array('pagination' => 'off'));
        
        foreach($rules as $rule) {
            $this->acl->allow($rule->getRole(), $rule->getResource());
        }
               
        
        return $this;
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
    
    public function getAcl()
    {
        return $this->acl;
    }
}