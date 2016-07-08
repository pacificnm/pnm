<?php
namespace Password\Controller;

use Zend\View\Model\ViewModel;
use Zend\Crypt\BlockCipher;
use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Password\Form\PasswordForm;
use Password\Service\PasswordServiceInterface;

class CreateController extends BaseController
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
     * @var PasswordForm
     */
    protected $passwordForm;

    /**
     *
     * @var array
     */
    protected $config;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param PasswordServiceInterface $passwordService            
     * @param PasswordForm $passwordForm            
     * @param array $config            
     */
    public function __construct(ClientServiceInterface $clientService, PasswordServiceInterface $passwordService, PasswordForm $passwordForm, array $config)
    {
        $this->clientService = $clientService;
        
        $this->passwordService = $passwordService;
        
        $this->passwordForm = $passwordForm;
        
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
        
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Create Password');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        // set head title
        $this->setHeadTitle($clientEntity->getClientName());
        
        // set form defaults
        $this->passwordForm->get('clientId')->setValue($id);
        
        $this->passwordForm->get('passwordId')->setValue(0);
        
        // request
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->passwordForm->setData($postData);
            
            // if we are valid
            if ($this->passwordForm->isValid()) {
                
                $passwordEntity = $this->passwordForm->getData();
                
                // encrypt password
                $blockCipher = BlockCipher::factory('mcrypt', array(
                    'algo' => 'aes'
                ));
                
                $blockCipher->setKey($this->config['encryption-key']);
                
                $passwordEntity->setPasswordPassword($blockCipher->encrypt($passwordEntity->getPasswordPassword()));
                
                // save the password
                $this->passwordService->save($passwordEntity);
                
                $this->flashmessenger()->addSuccessMessage('The password was saved.');
                
                // return to view it
                return $this->redirect()->toRoute('password-view', array(
                    'passwordId' => $passwordEntity->getPasswordId(),
                    'clientId' => $id
                ));
            }
        }
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->passwordForm
        ));
    }
}