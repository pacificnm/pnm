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
use HostAttributeMap\Form\OtherForm;

class CreateController extends BaseController
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
     * @param ClientServiceInterface $clientService            
     * @param HostServiceInterface $hostService            
     * @param MapServiceInterface $mapService            
     * @param WorkstationForm $workstationForm            
     * @param ServerForm $serverForm            
     * @param LaptopForm $laptopForm            
     * @param TabletForm $tabletForm            
     * @param PrinterForm $printerForm            
     * @param CopierForm $copierForm            
     * @param ScannerForm $scannerForm            
     * @param RouterForm $routerForm            
     * @param WirelessRouterForm $wirelessRouterForm            
     * @param AccessPointForm $accessPointForm            
     */
    public function __construct(ClientServiceInterface $clientService, HostServiceInterface $hostService, MapServiceInterface $mapService, WorkstationForm $workstationForm, ServerForm $serverForm, LaptopForm $laptopForm, TabletForm $tabletForm, PrinterForm $printerForm, CopierForm $copierForm, ScannerForm $scannerForm, RouterForm $routerForm, WirelessRouterForm $wirelessRouterForm, AccessPointForm $accessPointForm, OtherForm $otherForm)
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
        
        if (! $clientEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find client');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        if (! $hostEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find host');
            
            return $this->redirect()->toRoute('host-list', array(
                'clientId' => $id
            ));
        }
        
        // swithc on host type
        switch ($hostEntity->getHostTypeId()) {
            // work station
            case 1:
                $this->saveWorkstation($id, $hostId);
                break;
            // server
            case 2:
                $this->saveServer($id, $hostId);
                break;
            // laptop
            case 3:
                $this->saveLaptop($id, $hostId);
                break;
            // tablet
            case 4:
                $this->saveTablet($id, $hostId);
                break;
            // printer
            case 5:
                $this->savePrinter($id, $hostId);
                break;
            // copier
            case 6:
                $this->saveCopier($id, $hostId);
                break;
            // Scanner
            case 7:
                $this->saveScanner($id, $hostId);
                break;
            // router
            case 8:
                $this->saveRouter($id, $hostId);
                break;
            // switch
            case 9:
                $this->saveSwitch($id, $hostId);
                break;
            // wireless router
            case 10:
                $this->saveWirelessRouter($id, $hostId);
                break;
            // Access Point
            case 11:
                $this->saveAccessPoint($id, $hostId);
                break;
            default:
                $this->saveOther($id, $hostId);
                break;
        }
        
        // set layout defaults
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Create Host Attributes');
        
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
    protected function saveWorkstation($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/workstation.phtml');
        
        $this->viewModel->setVariable('form', $this->workstationForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->saveWorkstation($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    protected function saveOther($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/other.phtml');
        
        $this->viewModel->setVariable('form', $this->otherForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
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
    protected function saveServer($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/server.phtml');
        
        $this->viewModel->setVariable('form', $this->serverForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
    protected function saveLaptop($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/laptop.phtml');
        
        $this->viewModel->setVariable('form', $this->laptopForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
    protected function saveTablet($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/tablet.phtml');
        
        $this->viewModel->setVariable('form', $this->tabletForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
    protected function savePrinter($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/printer.phtml');
        
        $this->viewModel->setVariable('form', $this->printerForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
    protected function saveCopier($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/copier.phtml');
        
        $this->viewModel->setVariable('form', $this->copierForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
    protected function saveScanner($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/copier.phtml');
        
        $this->viewModel->setVariable('form', $this->scannerForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
    protected function saveRouter($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/router.phtml');
        
        $this->viewModel->setVariable('form', $this->routerForm);
        
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
    protected function saveSwitch($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/router.phtml');
        
        $this->viewModel->setVariable('form', $this->routerForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
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
    protected function saveWirelessRouter($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/wireless-router.phtml');
        
        $this->viewModel->setVariable('form', $this->wirelessRouterForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->saveWirelessRouter($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }

    protected function saveAccessPoint($clientId, $hostId)
    {
        $request = $this->getRequest();
        
        $this->viewModel->setTemplate('host-attribute-map/create/access-point.phtml');
        
        $this->viewModel->setVariable('form', $this->accessPointForm);
        
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->mapService->saveAccessPoint($hostId, $postData);
            
            $this->flashMessenger()->addSuccessMessage('Host Attributes where saved');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $clientId,
                'hostId' => $hostId
            ));
        }
    }
}
