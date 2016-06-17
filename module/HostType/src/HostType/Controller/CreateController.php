<?php
namespace HostType\Controller;

use Application\Controller\BaseController;
use HostType\Service\TypeServiceInterface;
use Zend\View\Model\ViewModel;
use HostType\Form\TypeForm;

class CreateController extends BaseController
{

    /**
     *
     * @var TypeServiceInterface
     */
    protected $typeService;

    /**
     *
     * @var TypeForm
     */
    protected $typeForm;

    /**
     *
     * @param TypeServiceInterface $typeService            
     * @param TypeForm $typeForm            
     */
    public function __construct(TypeServiceInterface $typeService, TypeForm $typeForm)
    {
        $this->typeService = $typeService;
        
        $this->typeForm = $typeForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->typeForm->setData($postData);
            
            // if we are valid
            if ($this->typeForm->isValid()) {
                $entity = $this->typeForm->getData();
                $entity = $this->typeService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The host type was saved');
                
                return $this->redirect()->toRoute('host-type-view', array(
                    'hostTypeId' => $entity->getHostTypeId()
                ));
            }
        }
        
        $this->typeForm->get('hostTypeId')->setValue(0);
        
        $this->layout()->setVariable('pageTitle', 'Host Type');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-type-index');
        
        return new ViewModel(array(
            'form' => $this->typeForm
        ));
    }
}