<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Auth\Entity\AuthEntity;

class BaseController extends AbstractActionController
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::onDispatch()
     */
    public function onDispatch(MvcEvent $e)
    {
        
        // check if we are installed
        if(! file_exists(APPLICATION_PATH . '/data/install')) {
            return $this->redirect()->toRoute('install-index');
        }
        
        // get router
        $router = $e->getRouteMatch();

        // module array
        $moduleArray = explode('\\', $router->getParam('controller'));
        
        // module name
        $module = $moduleArray[0];
        
        // check if we have an identity
        if (! $this->identity() || ! $this->identity() instanceof AuthEntity) {
            return $this->redirect()->toRoute('auth-sign-in', array(), array(
                'query' => array(
                    'from' => $router->getMatchedRouteName()
                )
            ));
        }
        
        // check if we are allowed to view the controller
        if (! $this->acl()->checkAcl($this->identity()
            ->getAuthRole(), $router->getMatchedRouteName())) {
            return $this->redirect()
                ->toRoute()
                ->setStatusCode(403);
        }
        
      
        if($this->identity()->getAuthRole() == 'administrator') {
            $adminAcl = true;
        } else {
            $adminAcl = false;
        }
        
        // if we are a user validate we own the client id we are requesting
        if($this->identity()->getUser() != 0) {
            $id = $this->params()->fromRoute('clientId', null);
            
            if($id) {
            
                if($this->identity()->getUserEntity()->getClientId() != $id) {
                    return $this->redirect()
                    ->toRoute()
                    ->setStatusCode(403);
                }
            }
        }
        
        $clientId = $this->getEvent()->getRouteMatch()->getParam('clientId', null);

        
        // set menu
        $this->layout()->setVariable('activeSubMenuItem', $router->getMatchedRouteName());
        
        $this->layout()->setVariable('activeMenuItem', strtolower($module));
        
        $this->layout()->setVariable('adminAcl', $adminAcl);
        
        $this->layout()->setVariable('acl', $this->acl()->getAcl());
        
        $this->layout()->setVariable('clientId', $clientId);
        
        // set page title
        $this->setPageTitle($router->getMatchedRouteName());
        
        
        
        // return parent dispatch
        return parent::onDispatch($e);
    }

    
}