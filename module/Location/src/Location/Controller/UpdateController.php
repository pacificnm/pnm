<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Location\Controller;

use Application\Controller\BaseController;
use Location\Service\LocationServiceInterface;
use Location\Form\LocationForm;
use Zend\View\Model\ViewModel;
use Client\Service\ClientServiceInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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
     * @var LocationForm
     */
    protected $locationForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param LocationServiceInterface $locationService            
     * @param LocationForm $locationForm            
     */
    public function __construct(ClientServiceInterface $clientService, LocationServiceInterface $locationService, LocationForm $locationForm)
    {
        $this->clientService = $clientService;
        
        $this->locationService = $locationService;
        
        $this->locationForm = $locationForm;
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
        
        $locationId = $this->params()->fromRoute('locationId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $locationEntity = $this->locationService->get($locationId);
        
        if (! $locationEntity) {
            $this->flashmessenger()->addErrorMessage('Location was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $request = $this->getRequest();
        
        
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
           
            $this->locationForm->setData($postData);
            $this->locationForm->getInputFilter()->remove('HasPrimary');
            
            // if we are valid
            if ($this->locationForm->isValid()) {
                
                $entity = $this->locationForm->getData();
                
                $this->locationService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The location was saved.');
                
                return $this->redirect()->toRoute('client-view', array(
                    'clientId' => $id
                ));
            }
        }
        
        $this->locationForm->bind($locationEntity);
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Location');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-view');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'form' => $this->locationForm
        ));
    }
}
