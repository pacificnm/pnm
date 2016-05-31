<?php
namespace Labor\Controller;

use Application\Controller\BaseController;
use Labor\Service\LaborServiceInterface;
use Zend\View\Model\ViewModel;
use Labor\Form\LaborForm;

class UpdateController extends BaseController
{

    /**
     *
     * @var LaborServiceInterface
     */
    protected $laborService;

    /**
     *
     * @var LaborForm
     */
    protected $laborForm;

    /**
     *
     * @param LaborServiceInterface $laborService            
     * @param LaborForm $laborForm            
     */
    public function __construct(LaborServiceInterface $laborService, LaborForm $laborForm)
    {
        $this->laborService = $laborService;
        
        $this->laborForm = $laborForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Labor');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'labor-index');
        
        $id = $this->params()->fromRoute('laborId');
        
        $laborEntity = $this->laborService->get($id);
        
        if (! $laborEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the labor  #' . $id);
            
            return $this->redirect()->toRoute('labor-index');
        }
        
        $this->laborForm->bind($laborEntity);
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->laborForm->setData($postData);
            
            // if we are valid
            if ($this->laborForm->isValid()) {
                
                $laborEntity = $this->laborForm->getData();
                
                $this->laborService->save($laborEntity);
                
                $this->flashmessenger()->addSuccessMessage('The labor rate was saved');
                
                return $this->redirect()->toRoute('labor-view', array(
                    'laborId' => $laborEntity->getLaborId()
                ));
            }
        }
        
        // return view
        return new ViewModel(array(
            'form' => $this->laborForm
        ));
    }
}