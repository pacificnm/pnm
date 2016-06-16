<?php
namespace Password\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Password\Service\PasswordServiceInterface;

class ViewController extends BaseController
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
     * @var array
     */
    protected $config;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param PasswordServiceInterface $passwordService            
     * @param array $config            
     */
    public function __construct(ClientServiceInterface $clientService, PasswordServiceInterface $passwordService, array $config)
    {
        $this->clientService = $clientService;
        
        $this->passwordService = $passwordService;
        
        $this->config = $config;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // make sure we have an encryption key
        if (! array_key_exists('encryption-key', $this->config) || empty($this->config['encryption-key'])) {
            throw new \Exception('missing encryption-key. You need to add the config key in the local.php config and provide a random string for default encryption');
        }
        
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
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' password ' . $passwordEntity->getPasswordTitle());
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Password');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'password-list');
        
        // set page title
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'passwordEntity' => $passwordEntity
        ));
    }
}