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
use Zend\View\Model\ViewModel;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class ViewController extends BaseController
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
     * @param ClientServiceInterface $clientService
     * @param LocationServiceInterface $locationService
     */
    public function __construct(ClientServiceInterface $clientService, LocationServiceInterface $locationService)
    {
        $this->clientService = $clientService;
        
        $this->locationService = $locationService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $locationId = $this->params()->fromRoute('locationId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-list');
        }
        
        $locationEntity = $this->locationService->get($locationId);
        
        if(! $locationEntity) {
            $this->flashmessenger()->addErrorMessage('Location was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Location');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'clientId' => $id,
            'locationEntity' => $locationEntity
        ));
    }
}
