<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Config\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Config\Service\ConfigServiceInterface;
use Config\Form\ConfigForm;
use Zend\Crypt\BlockCipher;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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
    protected $form;
    
    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @var BlockCipher
     */
    protected $blockCipher;
    /**
     * 
     * @param ConfigServiceInterface $configService
     * @param ConfigForm $configForm
     * @param array $config
     */
    public function __construct(ConfigServiceInterface $configService, ConfigForm $form, array $config)
    {
        $this->configService = $configService;
        
        $this->form = $form;
        
        $this->config = $config;
        
        $this->blockCipher = BlockCipher::factory('mcrypt', array(
            'algo' => 'aes'
        ));
        
        $this->blockCipher->setKey($this->config['encryption-key']);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
               
        $entity = $this->configService->get(1);
        
        
        $request = $this->getRequest();
        
        
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if we are valid
            if ($this->form->isValid()) {
                
                $entity = $this->form->getData();
                
                // check if smtp password is differnt
                if($entity->getConfigSmtpPassword()) {
                    $entity->setConfigSmtpPassword($this->blockCipher->encrypt($entity->getConfigSmtpPassword()));
                } 
                
                // check if we got a new panorama9 key
                if($entity->getConfigPanoramaKey()) {
                    $entity->setConfigPanoramaKey($this->blockCipher->encrypt($entity->getConfigPanoramaKey()));
                }
                
                $this->configService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The config was saved');
                
                return $this->redirect()->toRoute('config-index');
            }
        }
        
        $this->form->bind($entity);
        
        $this->form->get('configPanoramaKey')->setValue($this->blockCipher->decrypt($entity->getConfigPanoramaKey()));
        
        $this->form->get('configSmtpPassword')->setValue($this->blockCipher->decrypt($entity->getConfigSmtpPassword()));
       
        // return view model
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
    
}