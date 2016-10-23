<?php
namespace Cron\Controller;

use Application\Controller\BaseController;
use Cron\Service\CronServiceInterface;
use Cron\Form\CronForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{
    /**
     * 
     * @var CronServiceInterface
     */
    protected $cronService;
    
    /**
     * 
     * @var CronForm
     */
    protected $form;
    
    /**
     * 
     * @param CronServiceInterface $cronService
     * @param CronForm $form
     */
    public function __construct(CronServiceInterface $cronService, CronForm $form)
    {
        $this->cronService = $cronService;
        
        $this->form = $form;
    }
    
    public function indexAction()
    {
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
                $entity = $this->form->getData();
                
                $cronEntity = $this->cronService->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('cronCreate', $this, array(
                    'cronEntity' => $cronEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('Cron was saved');
                
                return $this->redirect()->toRoute('cron-index');
            }
        }
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}
