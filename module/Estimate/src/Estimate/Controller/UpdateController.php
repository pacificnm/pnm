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
use Estimate\Form\EstimateForm;
use Zend\View\Model\ViewModel;

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
     * @var EstimateServiceInterface
     */
    protected $estimateService;

    /**
     *
     * @var EstimateForm
     */
    protected $estimateForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param EstimateServiceInterface $estimateService            
     * @param EstimateForm $estimateForm            
     */
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService, EstimateForm $estimateForm)
    {
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;
        
        $this->estimateForm = $estimateForm;
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
        
        $request = $this->getRequest();
        
        $estimateId = $this->params()->fromRoute('estimateId');
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // load entity
        $estimateEntity = $this->estimateService->get($estimateId);
        
        if (! $estimateEntity) {
            $this->flashMessenger()->addErrorMessage('can not find estimate.');
            
            return $this->redirect()->toRoute('estimate-index', array(
                'clientId' => $id
            ));
        }
        
        $this->estimateForm->bind($estimateEntity);
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->estimateForm->setData($postData);
        
            if ($this->estimateForm->isValid()) {
        
                $entity = $this->estimateForm->getData();
        
                $entity->setEstimateDateDue(strtotime($entity->getEstimateDateDue));
                
                // save the estimate
                $estimateEntity = $this->estimateService->save($entity);
        
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Created Estimate ' . $estimateEntity->getEstimateId());
        
        
                $this->flashMessenger()->addSuccessMessage('The estimate was saved');
        
                // return to view estimate
                return $this->redirect()->toRoute('estimate-view', array(
                    'clientId' => $id,
                    'estimateId' => $estimateEntity->getEstimateId()
                ));
            }
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Estimates');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        // return view model
        return new ViewModel(array(
            'form' => $this->estimateForm
        ));
    }
}