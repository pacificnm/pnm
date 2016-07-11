<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Estimate\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Estimate\Service\EstimateServiceInterface;
use Zend\View\Model\ViewModel;
use Location\Service\LocationServiceInterface;
use Phone\Service\PhoneServiceInterface;
use EstimateOption\Service\OptionServiceInterface;
use EstimateOptionItem\Service\ItemServiceInterface;

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
     * @var EstimateServiceInterface
     */
    protected $estimateService;
    
    protected $locationService;
    
    protected $phoneService;
    
    protected $optionService;
    
    protected $itemService;
    
    
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService, LocationServiceInterface $locationService, PhoneServiceInterface $phoneService, OptionServiceInterface $optionService, ItemServiceInterface $itemService)
    {
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;

        $this->locationService = $locationService;
        
        $this->phoneService = $phoneService;
        
        $this->optionService = $optionService;
        
        $this->itemService = $itemService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $estimateId = $this->params()->fromRoute('estimateId');
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        // get estimate
        $estimateEntity = $this->estimateService->get($estimateId);
        
        // get client primary location
        $locationEntity = $this->locationService->getClientLocationByType($id, 'Primary');
        
        // get phone entity
        $phoneEntity = $this->phoneService->getPrimaryPhoneByLocation($locationEntity->getLocationId());
        
        // get estimate options
        $optionEntitys = $this->optionService->getEstimateOptions($estimateId);
        
        // loop through each option and get its items
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Estimates');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        // return view model
        return new ViewModel(array(
            'clientId' => $id,
            'clientEntity' => $clientEntity,
            'estimateEntity' => $estimateEntity,
            'locationEntity' => $locationEntity,
            'phoneEntity' => $phoneEntity,
            'optionEntitys' => $optionEntitys
        ));
    }
}