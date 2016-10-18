<?php
namespace Client\Controller\Plugin;

use Client\Service\ClientServiceInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ClientControllerPlugin extends AbstractPlugin
{
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     * 
     * @var unknown
     */
    protected $controllerPluginManager;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param unknown $controllerPluginManager
     */
    public function __construct(ClientServiceInterface $clientService, $controllerPluginManager)
    {
        $this->clientService = $clientService;
        
        $this->controllerPluginManager = $controllerPluginManager;
    }
    
    /**
     * 
     * @param unknown $clientId
     * @return \Client\Entity\ClientEntity
     */
    public function __invoke($clientId)
    {
        $clientEntity = $this->clientService->get($clientId);

        if(! $clientEntity) {
           $flashmessenger = $this->controllerPluginManager->get('flashMessenger');
           
           $flashmessenger->addErrorMessage('Client was not found.');
           
           $redirect = $this->controllerPluginManager->get('redirect');
           
           return $redirect->toRoute('client-index');
        }
        
        return $clientEntity;
    }
}

