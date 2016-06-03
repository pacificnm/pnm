<?php
namespace WorkorderNote\Controller;

use Application\Controller\BaseController;
use WorkorderNote\Service\NoteServiceInterface;
use WorkorderNote\Form\NoteForm;

class CreateController extends BaseController
{
    /**
     * 
     * @var NoteServiceInterface
     */
    protected $noteService;
    
    /**
     * 
     * @var NoteForm
     */
    protected $noteForm;
    
    /**
     * 
     * @param NoteServiceInterface $noteService
     * @param NoteForm $noteForm
     */
    public function __construct(NoteServiceInterface $noteService, NoteForm $noteForm)
    {
        $this->noteService = $noteService;
        
        $this->noteForm = $noteForm;
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
        
        // if we have a post
        if ($request->isPost()) {
            $postData = $request->getPost();
            
            $this->noteForm->setData($postData);
            
            if ($this->noteForm->isValid()) {
                
                $entity = $this->noteForm->getData();
                
                $entity->setWorkorderNotesDate(strtotime($postData['workorderNotesDate']));
                
                $noteEntity = $this->noteService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The work order note was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderId
                ));
            }
        }
        
        $this->flashmessenger()->addErrorMessage('The work order note was NOT saved.');
        
        return $this->redirect()->toRoute('workorder-view', array(
            'clientId' => $clientId,
            'workorderId' => $workorderId
        ));
    }
}
