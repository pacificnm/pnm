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
use Client\Service\ClientServiceInterface;
use Location\Service\LocationServiceInterface;
use Location\Form\LocationForm;
use Zend\View\Model\ViewModel;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class CreateController extends BaseController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-list');
        }
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
             
            $this->locationForm->setData($postData);
        
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
        
        $this->locationForm->get('clientId')->setValue($id);
        
        $this->locationForm->get('locationId')->setValue(0);
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'New Location');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'clientId' => $id,
            'form' => $this->locationForm
        ));
    }
}