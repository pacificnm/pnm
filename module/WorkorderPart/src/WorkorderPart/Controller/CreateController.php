<?php
namespace WorkorderPart\Controller;

use Application\Controller\BaseController;
use WorkorderPart\Service\PartServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderPart\Form\PartForm;

class CreateController extends BaseController
{

    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @var partForm
     */
    protected $partForm;

    /**
     *
     * @param PartServiceInterface $partService            
     * @param WorkorderServiceInterface $workorderService            
     * @param PartForm $partForm            
     */
    public function __construct(PartServiceInterface $partService, WorkorderServiceInterface $workorderService, PartForm $partForm)
    {   
        
        $this->partService = $partService;
        
        $this->workorderService = $workorderService;
        
        $this->partForm = $partForm;
    }

    /**
     *
     * {@inheritDoc}
     *
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
        
            $this->partForm->setData($postData);
        
            if ($this->partForm->isValid()) {
                $entity = $this->partForm->getData();
                
                $entity->setWorkorderPartsTotal($entity->getWorkorderPartsQty() * $entity->getWorkorderPartsAmount());
                
                $entity = $this->partService->save($entity);
                
                // load workorder
                $workorderEntity = $this->workorderService->get($workorderId);
                
                $workorderEntity->setWorkorderParts($workorderEntity->getWorkorderParts() + $entity->getWorkorderPartsTotal());
                
                $this->workorderService->save($workorderEntity);
                
                $this->flashmessenger()->addSuccessMessage('The work order part was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderId
                ));
            }
        }
    }
}