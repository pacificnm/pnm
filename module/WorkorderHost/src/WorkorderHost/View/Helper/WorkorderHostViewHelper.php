<?php
namespace WorkorderHost\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderHost\Service\WorkorderHostServiceInterface;
use WorkorderHost\Form\WorkorderHostForm;

class WorkorderHostViewHelper extends AbstractHelper
{

    /**
     *
     * @var WorkorderHostServiceInterface
     */
    protected $workorderHostservice;

    protected $workorderHostForm;

    /**
     *
     * @param WorkorderHostServiceInterface $workorderHostService            
     */
    public function __construct(WorkorderHostServiceInterface $workorderHostService, WorkorderHostForm $workorderHostForm)
    {
        $this->workorderHostservice = $workorderHostService;
        
        $this->workorderHostForm = $workorderHostForm;
    }

    /**
     *
     * @param unknown $workorderId            
     * @param unknown $workorderStatus            
     */
    public function __invoke($clientId, $workorderId, $workorderStatus)
    {
        $data = new \stdClass();
        
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $url = $view->plugin('url');
        
        $workorderHostEntitys = $this->workorderHostservice->getWorkorderHosts($workorderId);
        
        $this->workorderHostForm->setClientId($clientId);
        
        $this->workorderHostForm->setWorkorderId($workorderId);
        
        $this->workorderHostForm->setAttribute('action', $url('workorder-host-create', array(
            'clientId' => $clientId,
            'workorderId' => $workorderId
        )));
        
        $data->workorderHostEntitys = $workorderHostEntitys;
        
        $data->workorderStatus = $workorderStatus;
        
        $data->form = $this->workorderHostForm->getFormElements();
        
        $data->clientId = $clientId;
        
        $data->workorderId = $workorderId;
        
        return $partialHelper('partials/workorder-host.phtml', $data);
    }
}

