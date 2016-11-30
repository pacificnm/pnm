<?php
namespace PayrollTax\Controller;

use Application\Controller\BaseController;
use PayrollTax\Service\PayrollTaxServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{

    /**
     *
     * @var PayrollTaxServiceInterface
     */
    protected $service;

    /**
     *
     * @param PayrollTaxServiceInterface $service            
     */
    public function __construct(PayrollTaxServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $entity = $this->service->get(1);
        
        // trigger event view cron
        $this->getEventManager()->trigger('PayrollTaxIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

