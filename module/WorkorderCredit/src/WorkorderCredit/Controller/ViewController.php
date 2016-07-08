<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderCredit\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderCredit\Service\CreditServiceInterface;
use Zend\View\Model\ViewModel;

/**
 * Create Credit Controller
 *
 * @author jaimie (pacificnm@gmail.com)
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
     * @var WorkorderServiceInterface
     */
    protected $workorderService;
    
    /**
     *
     * @var CreditServiceInterface
     */
    protected $creditService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     * @param CreditServiceInterface $creditService
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, CreditServiceInterface $creditService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->creditService = $creditService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $workorderCreditId = $this->params()->fromRoute('workorderCreditId');
        
        // get client entity
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        // get work order entity
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
        
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        // get credit entity
        $creditEntity = $this->creditService->get($workorderCreditId);
        
        if(! $creditEntity) {
            $this->flashMessenger()->addErrorMessage('Credit was not found');
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Work Order Credit');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return view model
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'workorderEntity' => $workorderEntity,
            'creditEntity' => $creditEntity
        ));
    }
}
