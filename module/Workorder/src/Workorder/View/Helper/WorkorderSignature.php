<?php
namespace Workorder\View\Helper;

use Zend\View\Helper\AbstractHelper;

class WorkorderSignature extends AbstractHelper
{
    /**
     * 
     * @param string $workorderSignature
     */
    public function __invoke($workorderSignature)
    {
        $data  = new \stdClass();
        
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');

        $data->workorderSignature = $workorderSignature;
    
        return $partialHelper('partials/workorder-signature.phtml', $data);
    }
}

