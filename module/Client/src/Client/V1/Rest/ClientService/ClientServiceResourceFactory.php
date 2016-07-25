<?php
namespace Client\V1\Rest\ClientService;

class ClientServiceResourceFactory
{
    public function __invoke($services)
    {
        $clientService = $services->get('Client\Service\ClientServiceInterface');
        
        return new ClientServiceResource($clientService);
    }
}
