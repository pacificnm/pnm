<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;
use Auth\Form\AuthForm;

class UpdateController extends BaseController
{

    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     *
     * @var AuthForm
     */
    protected $authForm;

    /**
     *
     * @param AuthServiceInterface $authService            
     * @param AuthForm $authForm            
     */
    public function __construct(AuthServiceInterface $authService, AuthForm $authForm)
    {
        $this->authService = $authService;
        
        $this->authForm = $authForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Auth');
        
        $this->layout()->setVariable('pageSubTitle', 'Edit');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
        
        $authId = $this->params()->fromRoute('authId');
        
        $authEntity = $this->authService->get($authId);
        
        if(! $authEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the auth ' . $authId);
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        $this->authForm->bind($authEntity);
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->authForm->setData($postData);
            
            // if we are valid
            if ($this->authForm->isValid()) {
                $authEntity = $this->authForm->getData();
                
                $this->authService->save($authEntity);
                
                $this->flashmessenger()->addSuccessMessage('The Auth was saved');
                
                return $this->redirect()->toRoute('auth-view', array(
                    'authId' => $authEntity->getAuthId()
                ));
            }
        }
        
        return new ViewModel(array(
            'form' => $this->authForm
        ));
    }
}