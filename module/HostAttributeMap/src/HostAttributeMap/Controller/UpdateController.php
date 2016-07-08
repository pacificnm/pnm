<?php
namespace HostAttributeMap\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Host\Service\HostServiceInterface;
use HostAttributeMap\Service\MapServiceInterface;
use Zend\View\Model\ViewModel;
use HostAttributeMap\Form\WorkstationForm;
use HostAttributeMap\Form\ServerForm;
use HostAttributeMap\Form\LaptopForm;
use HostAttributeMap\Form\PrinterForm;
use HostAttributeMap\Form\TabletForm;
use HostAttributeMap\Form\CopierForm;
use HostAttributeMap\Form\ScannerForm;
use HostAttributeMap\Form\RouterForm;
use HostAttributeMap\Form\WirelessRouterForm;
use HostAttributeMap\Form\AccessPointForm;
use Zend\Crypt\BlockCipher;
use HostAttributeMap\Form\OtherForm;

class UpdateController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var HostServiceInterface
     */
    protected $hostService;

    /**
     *
     * @var MapServiceInterface
     */
    protected $mapService;

    /**
     *
     * @var WorkstationForm
     */
    protected $workstationForm;

    /**
     *
     * @var ServerForm
     */
    protected $serverForm;

    /**
     *
     * @var LaptopForm
     */
    protected $laptopForm;

    /**
     *
     * @var TabletForm
     */
    protected $tabletForm;

    /**
     *
     * @var PrinterForm
     */
    protected $printerForm;

    /**
     *
     * @var CopierForm
     */
    protected $copierForm;

    /**
     *
     * @var ScannerForm
     */
    protected $scannerForm;

    /**
     *
     * @var RouterForm
     */
    protected $routerForm;

    /**
     *
     * @var WirelessRouterForm
     */
    protected $wirelessRouterForm;

    /**
     *
     * @var AccessPointForm
     */
    protected $accessPointForm;

    /**
     *
     * @var OtherForm
     */
    protected $otherForm;

    /**
     *
     * @var ViewModel
     */
    protected $viewModel;

    /**
     *
     * @var array
     */
    protected $config;

    public function __construct(ClientServiceInterface $clientService, HostServiceInterface $hostService, MapServiceInterface $mapService, WorkstationForm $workstationForm, ServerForm $serverForm, LaptopForm $laptopForm, TabletForm $tabletForm, PrinterForm $printerForm, CopierForm $copierForm, ScannerForm $scannerForm, RouterForm $routerForm, WirelessRouterForm $wirelessRouterForm, AccessPointForm $accessPointForm, OtherForm $otherForm, $config)
    {
        $this->clientService = $clientService;
        
        $this->hostService = $hostService;
        
        $this->mapService = $mapService;
        
        $this->workstationForm = $workstationForm;
        
        $this->serverForm = $serverForm;
        
        $this->laptopForm = $laptopForm;
        
        $this->tabletForm = $tabletForm;
        
        $this->printerForm = $printerForm;
        
        $this->copierForm = $copierForm;
        
        $this->scannerForm = $scannerForm;
        
        $this->routerForm = $routerForm;
        
        $this->wirelessRouterForm = $wirelessRouterForm;
        
        $this->accessPointForm = $accessPointForm;
        
        $this->otherForm = $otherForm;
        
        $this->viewModel = new ViewModel();
        
        $this->config = $config;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $hostId = $this->params()->fromRoute('hostId');
        
        $clientEntity = $this->clientService->get($id);
        
        $hostEntity = $this->hostService->get($hostId);
        
        // validate client
        if (! $clientEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find client');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // validate host
        if (! $hostEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find host');
            
            return $this->redirect()->toRoute('host-list', array(
                'clientId' => $id
            ));
        }
        
        // get attribute set
        $mapEnitys = $this->mapService->getHostAttributes($hostId);
        
        // swithc on host type
        switch ($hostEntity->getHostTypeId()) {
            // work station
            case 1:
                $this->saveWorkstation($id, $hostId, $mapEnitys);
                break;
            // server
            case 2:
                $this->saveServer($id, $hostId, $mapEnitys);
                break;
            // laptop
            case 3:
                $this->saveLaptop($id, $hostId, $mapEnitys);
                break;
            // tablet
            case 4:
                $this->saveTablet($id, $hostId, $mapEnitys);
                break;
            // printer
            case 5:
                $this->savePrinter($id, $hostId, $mapEnitys);
                break;
            // copier
            case 6:
                $this->saveCopier($id, $hostId, $mapEnitys);
                break;
            // Scanner
            case 7:
                $this->saveScanner($id, $hostId, $mapEnitys);
                break;
            // router
            case 8:
                $this->saveRouter($id, $hostId, $mapEnitys);
                break;
            // switch
            case 9:
                $this->saveSwitch($id, $hostId, $mapEnitys);
                break;
            // wireless router
            case 10:
                $this->saveWirelessRouter($id, $hostId, $mapEnitys);
                break;
            // Access Point
            case 11:
                $this->saveAccessPoint($id, $hostId, $mapEnitys);
                break;
            default:
                $this->saveOther($id, $hostId, $mapEnitys);
                break;
        }
        
        // set layout defaults
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Host Attributes');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-list');
        
        return $this->viewModel;
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveWorkstation($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/workstation.phtml');
        
        $this->viewModel->setVariable('form', $this->workstationForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // operatingSystemId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 1) {
                $this->workstationForm->get('operatingSystemId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->workstationForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->workstationForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->workstationForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->workstationForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveWorkstation($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     * 
     * @param unknown $clientId
     * @param unknown $hostId
     * @param unknown $mapEnitys
     */
    protected function saveOther($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
    
        $this->viewModel->setTemplate('host-attribute-map/update/other.phtml');
    
        $this->viewModel->setVariable('form', $this->otherForm);
    
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // operatingSystemId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 1) {
                $this->otherForm->get('operatingSystemId')->setValue($mapEnity->getHostAttributeValueId());
            }
    
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->otherForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
    
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->otherForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->otherForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
    
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->otherForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
    
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
    
            $this->mapService->deleteHostMaps($hostId);
    
            $this->mapService->saveWorkstation($hostId, $postData);
    
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
    
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }
    
    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveServer($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/server.phtml');
        
        $this->viewModel->setVariable('form', $this->serverForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // operatingSystemId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 1) {
                $this->serverForm->get('operatingSystemId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->serverForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // serverTypeId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 20) {
                $this->serverForm->get('serverTypeId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->serverForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->serverForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->serverForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveServer($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveLaptop($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/laptop.phtml');
        
        $this->viewModel->setVariable('form', $this->laptopForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            // operatingSystemId
            
            // operatingSystemId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 1) {
                $this->laptopForm->get('operatingSystemId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->laptopForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->laptopForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->laptopForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->laptopForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveLaptop($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveTablet($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/tablet.phtml');
        
        $this->viewModel->setVariable('form', $this->tabletForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            // operatingSystemId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 1) {
                $this->tabletForm->get('operatingSystemId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->tabletForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->tabletForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->tabletForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->tabletForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveTablet($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function savePrinter($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/printer.phtml');
        
        $this->viewModel->setVariable('form', $this->printerForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            // username
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 6) {
                $this->printerForm->get('username')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
            
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
            
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 7) {
                $this->printerForm->get('password')->setValue($password);
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->printerForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->printerForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->printerForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->printerForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->savePrinter($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveCopier($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/copier.phtml');
        
        $this->viewModel->setVariable('form', $this->copierForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            
            // username
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 6) {
                $this->copierForm->get('username')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
            
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
            
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 7) {
                $this->copierForm->get('password')->setValue($password);
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->copierForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->copierForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->copierForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->copierForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveCopier($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveScanner($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/copier.phtml');
        
        $this->viewModel->setVariable('form', $this->scannerForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            
            // username
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 6) {
                $this->scannerForm->get('username')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
            
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
            
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 7) {
                $this->scannerForm->get('password')->setValue($password);
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->scannerForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->scannerForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->scannerForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->scannerForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveScanner($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveRouter($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/router.phtml');
        
        $this->viewModel->setVariable('form', $this->routerForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            // operatingSystemId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 1) {
                $this->routerForm->get('operatingSystemId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // username
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 6) {
                $this->routerForm->get('username')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
            
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
            
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 7) {
                $this->routerForm->get('password')->setValue($password);
            }
            
            // securityPassword
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 8) {
                $this->routerForm->get('securityPassword')->setValue($password);
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->routerForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->routerForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->routerForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->routerForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->saveRouter($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveSwitch($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/switch.phtml');
        
        $this->viewModel->setVariable('form', $this->routerForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            // operatingSystemId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 1) {
                $this->routerForm->get('operatingSystemId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // username
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 6) {
                $this->routerForm->get('username')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
            
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
            
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 7) {
                $this->routerForm->get('password')->setValue($password);
            }
            
            // securityPassword
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 8) {
                $this->routerForm->get('securityPassword')->setValue($password);
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->routerForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->routerForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->routerForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->routerForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
        }
        
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveSwitch($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param number $clientId            
     * @param number $hostId            
     */
    protected function saveWirelessRouter($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/wireless-router.phtml');
        
        $this->viewModel->setVariable('form', $this->wirelessRouterForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            // username
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 6) {
                $this->wirelessRouterForm->get('username')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
            
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
            
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 7) {
                $this->wirelessRouterForm->get('password')->setValue($password);
            }
            
            // securityPassword
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 8) {
                $this->wirelessRouterForm->get('securityPassword')->setValue($password);
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->wirelessRouterForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->wirelessRouterForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->wirelessRouterForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->wirelessRouterForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // ssid
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 9) {
                $this->wirelessRouterForm->get('ssid')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // securityType
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 4) {
                $this->wirelessRouterForm->get('securityType')->setValue($mapEnity->getHostAttributeValueId());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveWirelessRouter($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    /**
     *
     * @param unknown $clientId            
     * @param unknown $hostId            
     */
    protected function saveAccessPoint($clientId, $hostId, $mapEnitys)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/update/access-point.phtml');
        
        $this->viewModel->setVariable('form', $this->accessPointForm);
        
        // set form values
        foreach ($mapEnitys as $mapEnity) {
            // \Zend\Debug\Debug::dump($mapEnity);
            // username
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 6) {
                $this->accessPointForm->get('username')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
            
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
            
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 7) {
                $this->accessPointForm->get('password')->setValue($password);
            }
            
            // securityPassword
            $password = $blockCipher->decrypt($mapEnity->getHostAttributeMapValue());
            
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 8) {
                $this->accessPointForm->get('securityPassword')->setValue($password);
            }
            
            // manufactureId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 2) {
                $this->accessPointForm->get('manufactureId')->setValue($mapEnity->getHostAttributeValueId());
            }
            
            // modelId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 3) {
                $this->accessPointForm->get('modelId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            // assetTagId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 10) {
                $this->accessPointForm->get('assetTagId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // serialNumberId
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 11) {
                $this->accessPointForm->get('serialNumberId')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // ssid
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 9) {
                $this->accessPointForm->get('ssid')->setValue($mapEnity->getHostAttributeMapValue());
            }
            
            // securityType
            if ($mapEnity->getAttributeEntity()->getHostAttributeId() == 4) {
                $this->accessPointForm->get('securityType')->setValue($mapEnity->getHostAttributeValueId());
            }
        }
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->deleteHostMaps($hostId);
            
            $this->mapService->saveAccessPoint($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }
}
