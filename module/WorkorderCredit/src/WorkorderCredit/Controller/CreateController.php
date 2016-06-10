<?php
namespace WorkorderCredit\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderCredit\Service\CreditServiceInterface;
use WorkorderCredit\Form\CreditForm;

class CreateController extends BaseController
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
     * @var CreditForm
     */
    protected $creditForm;

    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     * @param CreditServiceInterface $creditService
     * @param CreditForm $creditForm
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, CreditServiceInterface $creditService, CreditForm $creditForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
       
        $this->creditService = $creditService;
        
        $this->creditForm = $creditForm;
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
        
        
        // if we have a post
        if ($request->isPost()) {
            $postData = $request->getPost();
        
            $this->creditForm->setData($postData);
        
            if ($this->creditForm->isValid()) {
        
                $entity = $this->creditForm->getData();
                
                $entity->setWorkorderCreditAmountLeft($entity->getWorkorderCreditAmount());
               
                $this->creditService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The work order credit was saved.');
        
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderId
                ));
            }
        }
        
        $this->flashmessenger()->addErrorMessage('The work order credit was NOT saved.');
        
        return $this->redirect()->toRoute('workorder-view', array(
            'clientId' => $clientId,
            'workorderId' => $workorderId
        ));
    }
}