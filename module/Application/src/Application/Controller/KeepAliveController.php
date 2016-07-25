<?php
namespace Application\Controller;

use Zend\View\Model\JsonModel;

class KeepAliveController extends BaseController
{
    public function __construct()
    {
        
    }
    
    public function indexAction()
    {
        return new JsonModel(array(
            'status' => 'OK',
            'name' => $this->identity()->getAuthName()
        ));
    }
}

