<?php

namespace Install\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Config\Service\ConfigServiceInterface;
use Install\Form\ConfigForm;


class ConfigController extends AbstractActionController
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
        $this->layout('layout/install.phtml');
        

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
        
                return $this->redirect()->toRoute('install-admin');
            }
        }
        
        return new ViewModel(array(
            'form' => $this->configForm
        ));
    }


}

