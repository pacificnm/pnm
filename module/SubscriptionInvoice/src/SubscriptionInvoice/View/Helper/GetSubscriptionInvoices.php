<?php
namespace SubscriptionInvoice\View\Helper;

use SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface;
use Zend\View\Helper\AbstractHelper;

class GetSubscriptionInvoices extends AbstractHelper
{

    /**
     *
     * @var SubscriptionInvoiceServiceInterface
     */
    protected $subscriptionInvoiceService;

    /**
     *
     * @param SubscriptionInvoiceServiceInterface $subscriptionInvoiceService            
     */
    public function __construct(SubscriptionInvoiceServiceInterface $subscriptionInvoiceService)
    {
        $this->subscriptionInvoiceService = $subscriptionInvoiceService;
    }

    /**
     *
     * @param number $subscriptionId            
     */
    public function __invoke($subscriptionId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $filter = array(
            'subscriptionId' => $subscriptionId
        );
        
        $subscriptionInvoiceEntitys = $this->subscriptionInvoiceService->getAll($filter);
        
        $data->subscriptionInvoiceEntitys = $subscriptionInvoiceEntitys;
        
        return $partialHelper('partials/get-subscription-invoices.phtml', $data);
    }
}

