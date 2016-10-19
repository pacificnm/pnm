<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Client\Service\ClientServiceInterface;
use Client\Form\ClientForm;
use Location\Service\LocationServiceInterface;
use Phone\Service\PhoneServiceInterface;
use Location\Form\LocationForm;
use Phone\Form\PhoneForm;
use Phone\Entity\PhoneEntity;
class UpdateController extends BaseController
{
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     *
     * @var LocationServiceInterface
     */
    protected $locationService;
    
    /**
     *
     * @var PhoneServiceInterface
     */
    protected $phoneService;
    
    /**
     * 
     * @var ClientForm
     */
    protected $clientForm;
    
    /**
     * 
     * @var PhoneForm
     */
    protected $phoneForm;
    
    /**
     * 
     * @var LocationForm
     */
    protected $locationForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param LocationServiceInterface $locationService
     * @param PhoneServiceInterface $phoneService
     * @param ClientForm $clientForm
     * @param LocationForm $locationForm
     * @param PhoneForm $phoneForm
     */
    public function __construct(ClientServiceInterface $clientService, LocationServiceInterface $locationService, PhoneServiceInterface $phoneService, ClientForm $clientForm, LocationForm $locationForm, PhoneForm $phoneForm)
    {
        $this->clientService = $clientService;
        
        $this->locationService = $locationService;
        
        $this->phoneService = $phoneService;
        
        $this->clientForm = $clientForm;
        
        $this->locationForm = $locationForm;
        
        $this->phoneForm = $phoneForm;
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
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {

            // get post
            $postData = $request->getPost();
            
            $postData->locationType = 'Primary';
            
            $postData->locationStatus = 'Active';
            
            $postData->phoneType = 'Primary';
            
            $this->clientForm->setData($postData);
            
            $this->phoneForm->setData($postData);
            
            $this->locationForm->setData($postData);
            
            // remove validation rule to save the location
            $this->locationForm->getInputFilter()->remove('HasPrimary');
            
                        
            // if valid
            if ($this->clientForm->isValid() && $this->phoneForm->isValid() && $this->locationForm->isValid()) {
               
                $clientEntity = $this->clientForm->getData();
                
                $locationEntity = $this->locationForm->getData();
                
                $phoneEntity = $this->phoneForm->getData();

                $clientEntity = $this->clientService->save($clientEntity);
                
                $locationEntity = $this->locationService->save($locationEntity);
                
                $phoneEntity->setLocationId($locationEntity->getLocationId());
                
                $phoneEntity = $this->phoneService->save($phoneEntity);
                
                $this->flashmessenger()->addSuccessMessage('The client was saved.');
                
                return $this->redirect()->toRoute('client-view', array(
                    'clientId' => $clientEntity->getClientId()
                ));
            }
        }
        
        // bind forms
        $this->clientForm->bind($clientEntity);
        
        $this->bindLocationForm($id);
        
        $this->bindPhoneForm($clientEntity->getPhoneEntity());
        
        // set vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Client');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return view model
        return new ViewModel(array(
            'form' => $this->clientForm,
            'locationForm' => $this->locationForm,
            'phoneForm' => $this->phoneForm
        ));
    }
    
    /**
     * 
     * @param unknown $clientId
     */
    protected function bindLocationForm($clientId)
    {
        $locationEntity = $this->locationService->getClientLocationByType($clientId, 'Primary');
        
        if(! $locationEntity) {
            $this->locationForm->get('locationId')->setValue(0);
        } else {
            $this->locationForm->bind($locationEntity);
        }
            
    }
   
    /**
     * 
     */
    protected function bindPhoneForm(PhoneEntity $phoneEntity)
    {
        
        if(! $phoneEntity->getPhoneId()) {
            $this->phoneForm->get('phoneId')->setValue(0);
        } else {
            $this->phoneForm->bind($phoneEntity);
        }
    }
}