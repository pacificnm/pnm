<?php
namespace WorkorderTime\Controller;

use Application\Controller\BaseController;
use WorkorderTime\Service\TimeServiceInterface;
use WorkorderTime\Form\TimeForm;
use Labor\Service\LaborServiceInterface;
use Workorder\Service\WorkorderServiceInterface;

class CreateController extends BaseController
{

    /**
     *
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     * 
     * @var LaborServiceInterface
     */
    protected $laborService;
    
    /**
     * 
     * @var WorkorderServiceInterface
     */
    protected $workorderService;
    /**
     *
     * @var TimeForm
     */
    protected $timeForm;

    /**
     * 
     * @param TimeServiceInterface $timeService
     * @param LaborServiceInterface $laborService
     * @param WorkorderServiceInterface $workorderService
     * @param TimeForm $timeForm
     */
    public function __construct(TimeServiceInterface $timeService, LaborServiceInterface $laborService, WorkorderServiceInterface $workorderService, TimeForm $timeForm)
    {
        $this->timeService = $timeService;
        
        $this->timeForm = $timeForm;
        
        $this->laborService = $laborService;
        
        $this->workorderService = $workorderService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $postData = $request->getPost();
            
            $postData = $request->getPost();
            
            $this->timeForm->setData($postData);
            
            if ($this->timeForm->isValid()) {
                
                $entity = $this->timeForm->getData();
                
                $laborEntity = $this->laborService->get($entity->getLaborId());
                
                $workorderEntity = $this->workorderService->get($workorderId);
                
                $timePieces = explode('-', $entity->getWorkorderTimeIn());
                
                $timeIn = strtotime($timePieces[0]);
                
                $timeOut = strtotime($timePieces[1]);
                
                $totalTime = $timeOut - $timeIn;
                
                // calculate labor total
                $laborTotal = number_format((($totalTime / 60) / 60) * $laborEntity->getLaborAmount(), 2);
                
                // @todo need to check if workorder has credit if so we deduct from credits
                
                
                // update entity
                $entity->setLaborName($laborEntity->getLaborName());
                
                $entity->setLaborRate($laborEntity->getLaborAmount());
                
                $entity->setWorkorderTimeIn($timeIn);
                
                $entity->setWorkorderTimeOut($timeOut);
                
                $entity->setWorkorderTimeTotal($totalTime);
                
                $entity->setLaborTotal($laborTotal);
                
                $entity = $this->timeService->save($entity);
                
                // update workorder
                $workorderEntity->setWorkorderLabor($workorderEntity->getWorkorderLabor() + $entity->getLaborTotal());
                
                $this->workorderService->save($workorderEntity);
                
                // @todo send email notifications that labor was added
                
                // @todo update user history, there are two evens 1 the employee added labor and 2 the workorder got labor
                
                $this->flashmessenger()->addSuccessMessage('The work order time was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderId
                ));
            }
            
        }
        
        \Zend\Debug\Debug::dump($this->timeForm->getMessages());
        
        die;
        
        $this->flashmessenger()->addErrorMessage('The work order time was NOT saved.');
        
        return $this->redirect()->toRoute('workorder-view', array(
            'clientId' => $clientId,
            'workorderId' => $workorderId
        ));
    }
}