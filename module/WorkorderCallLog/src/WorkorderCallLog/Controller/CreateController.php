<?php
namespace WorkorderCallLog\Controller;

use Application\Controller\BaseController;
use WorkorderCallLog\Service\WorkorderCallLogServiceInterface;
use CallLog\Service\LogServiceInterface;
use WorkorderCallLog\Form\WorkorderCallLogForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{

    /**
     *
     * @var WorkorderCallLogServiceInterface
     */
    protected $workorderCallLogService;

    /**
     *
     * @var LogServiceInterface
     */
    protected $logService;

    /**
     *
     * @var WorkorderCallLogForm
     */
    protected $form;

    /**
     *
     * @param WorkorderCallLogServiceInterface $workorderCallLogService            
     * @param LogServiceInterface $logService            
     * @param WorkorderCallLogForm $form            
     */
    public function __construct(WorkorderCallLogServiceInterface $workorderCallLogService, LogServiceInterface $logService, WorkorderCallLogForm $form)
    {
        $this->workorderCallLogService = $workorderCallLogService;
        
        $this->logService = $logService;
        
        $this->form = $form;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $callLogId = $this->params('callLogId');
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            // if we are valid
            if ($this->form->isValid()) {
                
                $entity = $this->form->getData();
                
                $entity->setWorkorderId($postData['workorderId']);
          
                $WorkorderCallLogEntity = $this->workorderCallLogService->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('workorderCallLogCreate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'logId' => $WorkorderCallLogEntity->getCallLogId(),
                    'workorderId' => $WorkorderCallLogEntity->getWorkorderId()
                ));
                
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Call log saved to work order');
                
                // return to view work order
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $this->clientId,
                    'workorderId' => $WorkorderCallLogEntity->getWorkorderId()
                ));
            }
        }
        
        // set form default values
        $this->form->setClientId($this->clientId);
        
        $this->form->get('callLogId')->setValue($callLogId);
        
        $this->form->get('workorderCallLogCreated')->setValue(time());
        
        $this->form->get('workorderCallLogId')->setValue(0);
        
        $this->form->setWorkorders();
        
        // overide page title
        $this->layout()->setVariable('pageSubTitle', 'Add To Work Order');
        
        // return view model
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}

?>