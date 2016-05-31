<?php
namespace Labor\Controller;

use Application\Controller\BaseController;
use Labor\Service\LaborServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{

    /**
     *
     * @var LaborServiceInterface
     */
    protected $laborService;

    /**
     *
     * @param LaborServiceInterface $laborService            
     */
    public function __construct(LaborServiceInterface $laborService)
    {
        $this->laborService = $laborService;
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
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $this->laborService->delete($laborEntity);
                
                $this->flashmessenger()->addSuccessMessage('The labor rate was deleted');
                
                return $this->redirect()->toRoute('labor-index');
            }
            
            // return to view
            return $this->redirect()->toRoute('labor-view', array(
                'laborId' => $id
            ));
        }
        
        // return view
        return new ViewModel(array(
            'laborEntity' => $laborEntity
        ));
    }
}