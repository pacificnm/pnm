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
     * @param ClientServiceInterface $clientService
     * @param EstimateServiceInterface $estimateService
     */
    public function __construct(ClientServiceInterface $clientService, EstimateServiceInterface $estimateService)
    {
        $this->clientService = $clientService;
        
        $this->estimateService = $estimateService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Estimates');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'estimate-index');
        
        // return view model
        return new ViewModel();
    }
}