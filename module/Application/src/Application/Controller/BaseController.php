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
        if (! file_exists(APPLICATION_PATH . '/data/install')) {
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
        
        if ($this->identity()->getAuthRole() == 'administrator') {
            $adminAcl = true;
        } else {
            $adminAcl = false;
        }
        
        // if we are a user validate we own the client id we are requesting
        if ($this->identity()->getUser() != 0) {
            $id = $this->params()->fromRoute('clientId', null);
            
            if ($id) {
                
                if ($this->identity()
                    ->getUserEntity()
                    ->getClientId() != $id) {
                    return $this->redirect()
                        ->toRoute()
                        ->setStatusCode(403);
                }
            }
        }
        
        $clientId = $this->getEvent()
            ->getRouteMatch()
            ->getParam('clientId', null);
        
        // set active Menu
        $this->SetActiveMenu($router->getMatchedRouteName(), $this->layout());
        
        // set page title
        $this->setPageTitle($router->getMatchedRouteName(), $this->layout());
        
        // set page Sub Title
        $this->SetPageSubTitle($router->getMatchedRouteName(), $this->layout());
        
        // set admin acl
        $this->layout()->setVariable('adminAcl', $adminAcl);
        
        // set active menu
        $this->SetActiveMenu($router->getMatchedRouteName(), $this->layout());
        
        // set activeSubMenu
        $this->SetActiveSubMenu($router->getMatchedRouteName(), $this->layout());
        
        // assign acl to layout
        $this->layout()->setVariable('acl', $this->acl()
            ->getAcl());
        
        // assign client id to layout
        $this->layout()->setVariable('clientId', $clientId);
        
        // set session timeout
        $maxlifetime = ini_get("session.gc_maxlifetime") - 120;
        
        $this->layout()->setVariable('maxlifetime', $maxlifetime);
        
        // return parent dispatch
        return parent::onDispatch($e);
    }
}