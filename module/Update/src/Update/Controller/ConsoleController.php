<?php
namespace Update\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Install\Service\InstallServiceInterface;
use AclResource\Service\ResourceServiceInterface;
use AclResource\Entity\ResourceEntity;
use AclRole\Service\RoleServiceInterface;
use AclRole\Entity\RoleEntity;
use Acl\Service\AclServiceInterface;
use Acl\Entity\AclEntity;

class ConsoleController extends AbstractActionController
{
    /**
     * 
     * @var InstallServiceInterface
     */
    protected $installService;
    
    /**
     * 
     * @var ResourceServiceInterface
     */
    protected $resourceService;
    
    /**
     * 
     * @var RoleServiceInterface
     */
    protected $roleService;
    
    /**
     * 
     * @var AclServiceInterface
     */
    protected $aclService;
    
    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @param InstallServiceInterface $installService
     * @param ResourceServiceInterface $resourceService
     * @param RoleServiceInterface $roleService
     * @param AclServiceInterface $acl
     * @param array $config
     */
    public function __construct(InstallServiceInterface $installService, ResourceServiceInterface $resourceService, RoleServiceInterface $roleService, AclServiceInterface $aclService, array $config)
    {
        $this->installService = $installService;
        
        $this->resourceService = $resourceService;
        
        $this->roleService = $roleService;
        
        $this->aclService = $aclService;
        
        $this->config = $config;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // load request
        $request = $this->getRequest();
        
        // validate we are in a console
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($request));
        }
        
        // load console
        $console = $this->getServiceLocator()->get('console');
        
        $start = date('m/d/Y h:i a', time());
        
        $console->write("Start Update at {$start}\n", 3);
        
        // update all database files
        $it = new \RecursiveDirectoryIterator("module");
        
        $display = array(
            'sql'
        );

        foreach (new \RecursiveIteratorIterator($it) as $file) {
        
            $fileExt = explode('.', $file);
            
            $check = strtolower(array_pop($fileExt));

            if (in_array($check, $display)) {
        
                $sql = file_get_contents($file);
        
                //$console->write("working on sql file {$file}\n");
                
                $result = $this->installService->installTabel($sql);
                
                if($result) {
                    $console->write("Updating sql file {$file}\n");
                }
            }
        }
        
        // done with database files
        $console->write("Done with database updates\n", 3);
        
        
        
        
        
        foreach($this->config['module'] as $module) {
            $allResources = array();
            
            $name = $module['name'];
            
            $console->write("Updating module {$name}\n");
            
            if(array_key_exists('acl', $module)) {
               $roles = $module['acl'];
               
               // loop though roles and create resources
               foreach ($roles as $role => $resources) {
                   
                   // all resources
                   $allResources = array_merge($resources, $allResources);
                   
                   // roles
                   $console->write("Updating role {$role}\n");
                   $roleEntity = $this->roleService->getRole($role);
                   if(! $roleEntity) {
                       $entity = new RoleEntity();
                       $entity->setAclRole($role);
                       $entity->setAclRoleId(0);
                       $this->roleService->save($entity);
                   }
                   
                   // reources
                   if($resources) {
                       foreach($resources as $resource) {
                           $console->write("Updating resource {$resource}\n");
                           $resourceEntity = $this->resourceService->getReource($resource);
                           
                           // if no reource create it
                           if(! $resourceEntity) {
                               $entity = new ResourceEntity();
                               //$entity->setAclResourceId(0);
                               $entity->setAclResource($resource);
                               
                               $this->resourceService->save($entity);
                           }
                       }
                   }
                   
                   // rules
                   foreach ($allResources as $resource) {
                       $console->write("Updating rule {$role} allowed {$resource}\n");
                       $aclEntity = $this->aclService->getAclRule($role, $resource);
                       if(! $aclEntity) {
                           $entity = new AclEntity();
                           //$entity->setAclId(0);
                           $entity->setRole($role);
                           $entity->setResource($resource);
                           
                           $this->aclService->save($entity);
                       }
                       
                   }
               }
                
            }
        }
        $console->write("Done with module updates\n", 3);
        
        // done
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Comleted Update at {$end}\n", 3);
    }
}