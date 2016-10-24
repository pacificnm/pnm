<?php
namespace Log\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
{
    public function __construct()
    {
        
    }
    
    public function indexAction()
    {
        
        $file = $this->params()->fromRoute('file');
        
        $fileContent = file_get_contents('./data/log/' .$file);
        
        return new ViewModel(array(
            'fileContent' => $fileContent
        ));
    }
}