<?php
namespace Workorder\V1\Rest\ClientTotalLabor;

class ClientTotalLaborResourceFactory
{
    public function __invoke($services)
    {
        return new ClientTotalLaborResource();
    }
}
