<?php
namespace Config\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Config\Service\ConfigServiceInterface;
use Config\Form\ConfigForm;

class UpdateController extends BaseController
{
    /**
     * 
     * @var ConfigServiceInterface
     */
    protected $configService;
    
    /**
     * 
     * @var ConfigForm
     */
    protected $configForm;
    
    /**
     * 
     * @param ConfigServiceInterface $configService
     * @param ConfigForm $configForm
     */
    public function __construct(ConfigServiceInterface $configService, ConfigForm $configForm)
    {
        $this->configService = $configService;
        
        $this->configForm = $configForm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Edit Config');
    
        $this->layout()->setVariable('pageSubTitle', '');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'config-index');
        
        $configEntity = $this->configService->get(1);
        
        $this->configForm->bind($configEntity);
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->configForm->setData($postData);
        
            // if we are valid
            if ($this->configForm->isValid()) {
                
                $configEntity = $this->configForm->getData();
                
                $this->configService->save($configEntity);
                
                $this->flashmessenger()->addSuccessMessage('The config was saved');
                
                return $this->redirect()->toRoute('config-index');
            }
        }
        return new ViewModel(array(
            'form' => $this->configForm
        ));
    }
}