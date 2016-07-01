<?php
namespace Workorder\V1\Rest\ClientTotalCount;

class ClientTotalCountResourceFactory
{
    public function __invoke($services)
    {
        return new ClientTotalCountResource();
    }
}
