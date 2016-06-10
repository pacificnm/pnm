<?php
namespace WorkorderPart\Controller;

use Application\Controller\BaseController;
use WorkorderPart\Service\PartServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderPart\Form\PartForm;
use WorkorderCredit\Service\CreditServiceInterface;

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
     * @var CreditServiceInterface
     */
    protected $creditService;
    /**
     *
     * @var partForm
     */
    protected $partForm;

    /**
     * 
     * @param PartServiceInterface $partService
     * @param WorkorderServiceInterface $workorderService
     * @param CreditServiceInterface $creditService
     * @param PartForm $partForm
     */
    public function __construct(PartServiceInterface $partService, WorkorderServiceInterface $workorderService, CreditServiceInterface $creditService, PartForm $partForm)
    {   
        
        $this->partService = $partService;
        
        $this->workorderService = $workorderService;
        
        $this->creditService = $creditService;
        
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
                
                // if we have credit subtract it
                $creditEntity = $this->creditService->getWorkorderPartCredit($workorderId);
              
                
                if($creditEntity) {
                    if(($creditEntity->getWorkorderCreditAmountLeft() - $entity->getWorkorderPartsTotal()) > 0) {
                        $creditEntity->setWorkorderCreditAmountLeft($creditEntity->getWorkorderCreditAmountLeft() - $entity->getWorkorderPartsTotal());
                    } else {
                        $creditEntity->setWorkorderCreditAmountLeft(0);
                    }
                    
                    $this->creditService->save($creditEntity);
                }
                
                $this->flashmessenger()->addSuccessMessage('The work order part was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderId
                ));
            }
        }
    }
}