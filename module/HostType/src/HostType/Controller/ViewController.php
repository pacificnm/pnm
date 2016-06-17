<?php
namespace HostType\Controller;

use Application\Controller\BaseController;
use HostType\Service\TypeServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
{

    /**
     *
     * @var TypeServiceInterface
     */
    protected $typeService;
    
    /**
     *
     * @param TypeServiceInterface $typeService
     */
    public function __construct(TypeServiceInterface $typeService)
    {
        $this->typeService = $typeService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'Admin View Host Type');
        
        $id = $this->params()->fromRoute('hostTypeId');
        
        $typeEntity = $this->typeService->get($id);
        
        if(! $typeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the host type');
            
            return $this->redirect()->toRoute('host-type-index');
        }
        
        $this->layout()->setVariable('pageTitle', 'View Host Type');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-type-index');
        
        return new ViewModel(array(
            'typeEntity' => $typeEntity
        ));
    }
}