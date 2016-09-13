<?php
namespace File\V1\Rest\ClientFile;

class ClientFileResourceFactory
{
    public function __invoke($services)
    {
        return new ClientFileResource();
    }
}
