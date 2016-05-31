<?php
namespace Labor\Controller;

use Application\Controller\BaseController;
use Labor\Service\LaborServiceInterface;
use Zend\View\Model\ViewModel;
use Labor\Form\LaborForm;

class CreateController extends BaseController
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
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Labor');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
        
        $this->laborForm->get('laborId')->setValue(0);
        
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
        
        return new ViewModel(array(
            'form' => $this->laborForm
        ));
    }
}