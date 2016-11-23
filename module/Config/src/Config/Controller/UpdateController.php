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
    protected $configForm;
    
    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @param ConfigServiceInterface $configService
     * @param ConfigForm $configForm
     * @param array $config
     */
    public function __construct(ConfigServiceInterface $configService, ConfigForm $configForm, array $config)
    {
        $this->configService = $configService;
        
        $this->configForm = $configForm;
        
        $this->config = $config;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
               
        $configEntity = $this->configService->get(1);
        
        $this->configForm->bind($configEntity);
        
        $request = $this->getRequest();
        
        $tempSmtpPassword = $configEntity->getConfigSmtpPassword();
        
        $tempPanoramaKey = $configEntity->getConfigPanoramaKey();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->configForm->setData($postData);
        
            // if we are valid
            if ($this->configForm->isValid()) {
                
                $configEntity = $this->configForm->getData();
                
                // check if smtp password is differnt
                if($tempSmtpPassword != $configEntity->getConfigSmtpPassword()) {
                    $blockCipher = BlockCipher::factory('mcrypt', array(
                        'algo' => 'aes'
                    ));
                    
                    $blockCipher->setKey($this->config['encryption-key']);
                    
                    $configEntity->setConfigSmtpPassword($blockCipher->encrypt($configEntity->getConfigSmtpPassword()));
                } else {
                    $configEntity->setConfigSmtpPassword($tempSmtpPassword);
                }
                
                // check if we got a new panorama9 key
                if($tempPanoramaKey != $configEntity->getConfigPanoramaKey()) {
                    $blockCipher = BlockCipher::factory('mcrypt', array(
                        'algo' => 'aes'
                    ));
                    
                    $blockCipher->setKey($this->config['encryption-key']);
                    
                    $configEntity->setConfigPanoramaKey($blockCipher->encrypt($configEntity->getConfigPanoramaKey()));
                } else {
                    $configEntity->setConfigPanoramaKey($tempPanoramaKey);
                }
                
                $this->configService->save($configEntity);
                
                $this->flashmessenger()->addSuccessMessage('The config was saved');
                
                return $this->redirect()->toRoute('config-index');
            }
        }
        
        // return view model
        return new ViewModel(array(
            'form' => $this->configForm
        ));
    }
    
}