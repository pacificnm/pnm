<?php
namespace Password\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Password\Service\PasswordServiceInterface;

class DeleteController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var PasswordServiceInterface
     */
    protected $passwordService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param PasswordServiceInterface $passwordService            
     */
    public function __construct(ClientServiceInterface $clientService, PasswordServiceInterface $passwordService)
    {
        $this->clientService = $clientService;
        
        $this->passwordService = $passwordService;
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
        
        $passwordId = $this->params()->fromRoute('passwordId');
        
        $clientEntity = $this->clientService->get($id);
        
        $passwordEntity = $this->passwordService->get($passwordId);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        // validate we got a password
        if (! $passwordEntity) {
            $this->flashmessenger()->addErrorMessage('Password was not found.');
            
            return $this->redirect()->toRoute('password-list', array(
                'clientId' => $id
            ));
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Password');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        // set head title
        $this->setHeadTitle($clientEntity->getClientName());
        
        // request
        $request = $this->getRequest();
        
        // if post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $this->passwordService->delete($passwordEntity);
                
                $this->flashmessenger()->addSuccessMessage('The password was deleted');
                
                return $this->redirect()->toRoute('password-list', array(
                    'clientId' => $id
                ));
            }
            
            // return to view
            return $this->redirect()->toRoute('password-view', array(
                'passwordId' => $passwordId,
                'clientId' => $id
            ));
        }
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'passwordEntity' => $passwordEntity
        ));
    }
}