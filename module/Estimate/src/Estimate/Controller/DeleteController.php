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
use EstimateOption\Service\OptionServiceInterface;
use EstimateOptionItem\Service\ItemServiceInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class DeleteController extends BaseController
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
    
    /**
     * 
     * @var OptionServiceInterface
     */
    protected $optionService;
    
    /**
     * 
     * @var ItemServiceInterface
     */
    protected $itemService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param EstimateServiceInterface $estimateService
     * @param OptionServiceInterface $optionService
     * @param ItemServiceInterface $itemService
     */
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService, OptionServiceInterface $optionService, ItemServiceInterface $itemService)
    {
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;
        
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
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        $estimateEntity = $this->estimateService->get($estimateId);
        
        if(! $estimateEntity) {
            $this->flashMessenger()->addErrorMessage('Estimate was not found');
            
            return $this->redirect()->toRoute('estimate-index', array('clientId' => $id));
        }
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'DELETE', $this->identity()
                    ->getAuthId(), 'Deleted Estimate ' . $estimateEntity->getEstimateId());
        
                // load all options and delete
                $optionEntitys = $this->optionService->getEstimateOptions($estimateId);
                
                foreach($optionEntitys as $optionEntity) {
                    $this->itemService->deleteOptionItems($optionEntity->getEstimateOptionId());
                    
                    $this->optionService->delete($optionEntity);
                }
                
                $this->estimateService->delete($estimateEntity);
        
                $this->flashMessenger()->addSuccessMessage('The estimate was deleted');
                
                return $this->redirect()->toRoute('estimate-index', array('clientId' => $id));
            }
        
            return $this->redirect()->toRoute('estimate-view', array('clientId' => $id, 'estimateId' => $estimateId));
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Estimates');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        // return view model
        return new ViewModel(array(
            'estimateEntity' => $estimateEntity
        ));
    }
}