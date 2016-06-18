<?php
namespace HostAttribute\Controller;

use Application\Controller\BaseController;
use HostAttribute\Service\AttributeServiceInterface;
use Zend\View\Model\ViewModel;
use HostAttributeValue\Service\ValueServiceInterface;

class ViewController extends BaseController
{
    /**
     *
     * @var AttributeServiceInterface
     */
    protected $attributeService;
    
    /**
     * 
     * @var ValueServiceInterface
     */
    protected $valueService;
    
    /**
     * 
     * @param AttributeServiceInterface $attributeService
     * @param ValueServiceInterface $valueService
     */
    public function __construct(AttributeServiceInterface $attributeService, ValueServiceInterface $valueService)
    {
        $this->attributeService = $attributeService;
        
        $this->valueService = $valueService;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        $id = $this->params()->fromRoute('hostAttributeId');
        
        $attributeEntity = $this->attributeService->get($id);
        
        if(! $attributeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the host attribute');
        
            return $this->redirect()->toRoute('host-attribute-index');
        }
        
        $paginator = $this->valueService->getAttributeValues($id);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        $this->layout()->setVariable('pageTitle', 'Host Attribute');
    
        $this->layout()->setVariable('pageSubTitle', '');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'host-attribute-index');
    
        return new ViewModel(array(
            'attributeEntity' => $attributeEntity,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(),
        ));
    }
}
