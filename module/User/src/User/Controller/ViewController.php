<?php
namespace User\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use User\Service\UserServiceInterface;

class ViewController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param UserServiceInterface $userService            
     */
    public function __construct(ClientServiceInterface $clientService, UserServiceInterface $userService)
    {
        $this->clientService = $clientService;
        
        $this->userService = $userService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $userId = $this->params()->fromRoute('userId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        $userEntity = $this->userService->get($userId);
        
        if (! $userEntity) {
            $this->flashmessenger()->addErrorMessage('User was not found.');
            
            return $this->redirect()->toRoute('user-list', array(
                'clientId' => $id
            ));
        }
        
        // set layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View User');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'user-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'userEntity' => $userEntity
        ));
    }
}