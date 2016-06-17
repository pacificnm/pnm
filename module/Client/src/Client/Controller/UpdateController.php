<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Client\Service\ClientServiceInterface;
use Client\Form\ClientForm;
class UpdateController extends BaseController
{
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     * 
     * @var ClientForm
     */
    protected $clientForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     */
    public function __construct(ClientServiceInterface $clientService, ClientForm $clientForm)
    {
        $this->clientService = $clientService;
        
        $this->clientForm = $clientForm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            
        }
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->clientForm->setData($postData);
            
            if ($this->clientForm->isValid()) {
                $clientEntity = $this->clientForm->getData();
                
                $clientEntity = $this->clientService->save($clientEntity);
                
                $this->flashmessenger()->addSuccessMessage('The client was saved.');
                
                return $this->redirect()->toRoute('client-view', array(
                    'clientId' => $clientEntity->getClientId()
                ));
            }
        }
        
        $this->clientForm->bind($clientEntity);
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Client');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'form' => $this->clientForm
        ));
    }
}