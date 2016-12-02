<?php
namespace Invoice\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use Product\Service\ProductServiceInterface;
use Invoice\Entity\InvoiceEntity;
use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;
use SubscriptionInvoice\Service\SubscriptionInvoiceService;

class InvoiceListener implements ListenerAggregateInterface
{

    protected $listeners = array();

    /**
     *
     * @var InvoiceServiceInterface
     */
    protected $invoiceService;

    /**
     *
     * @var ItemServiceInterface
     */
    protected $itemService;
    
    /**
     * 
     * @var SubscriptionInvoiceService
     */
    protected $subscriptionInvoiceService;
    
    /**
     *
     * @var ProductServiceInterface
     */
    protected $productService;

    /**
     * 
     * @param InvoiceServiceInterface $invoiceService
     * @param ItemServiceInterface $itemService
     * @param SubscriptionInvoiceService $subscriptionInvoiceService
     * @param ProductServiceInterface $productService
     */
    public function __construct(InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, SubscriptionInvoiceService $subscriptionInvoiceService, ProductServiceInterface $productService)
    {
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->productService = $productService;
        
        $this->subscriptionInvoiceService = $subscriptionInvoiceService;
    }

    /**
     *
     * @param EventInterface $event            
     */
    public function subscriptionCreate(EventInterface $event)
    {
        $subscriptionEntity = $event->getParam('subscriptionEntity');
        
        $clientId = $subscriptionEntity->getClientId();
        
        // create invoice
        $invoiceEntity = new InvoiceEntity();
        
        $invoiceEntity->setClientId($clientId);
        
        $invoiceEntity->setInvoiceBalance(0);
        
        $invoiceEntity->setInvoiceDate($subscriptionEntity->getSubscriptionDateDue());
        
        $invoiceEntity->setInvoiceDateEnd($subscriptionEntity->getSubscriptionDateEnd());
        
        $invoiceEntity->setInvoiceDatePaid(0);
        
        $invoiceEntity->setInvoiceDateStart($subscriptionEntity->getSubscriptionDateDue());
        
        $invoiceEntity->setInvoiceDiscount(0);
        
        $invoiceEntity->setInvoiceId(0);
        
        $invoiceEntity->setInvoicePayment(0);
        
        $invoiceEntity->setInvoiceStatus('Un-Paid');
        
        $invoiceEntity->setInvoiceSubtotal(0);
        
        $invoiceEntity->setInvoiceTax(0);
        
        $invoiceEntity->setInvoiceTotal(0);
        
        $invoiceEntity = $this->invoiceService->save($invoiceEntity);
                
        // map invoice to subscription
        $subscriptionInvoiceEntity = new SubscriptionInvoiceEntity();
        
        $subscriptionInvoiceEntity->setInvoiceId($invoiceEntity->getInvoiceId());
        
        $subscriptionInvoiceEntity->setSubscriptionId($subscriptionEntity->getSubscriptionId());
        
        $this->subscriptionInvoiceService->save($subscriptionInvoiceEntity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
    {
        $this->listeners = array(
            $events->attach('subscriptionCreate', array(
                $this,
                'subscriptionCreate'
            ))
        );
        
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::detach()
     */
    public function detach(\Zend\EventManager\EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
        
        return $this;
    }
}