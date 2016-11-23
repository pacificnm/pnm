<?php
namespace Invoice\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use SubscriptionHost\Service\SubscriptionHostServiceInterface;
use Product\Service\ProductServiceInterface;
use Invoice\Entity\InvoiceEntity;
use InvoiceItem\Entity\ItemEntity;
use Product\Entity\ProductEntity;
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
     * @var SubscriptionHostServiceInterface
     */
    protected $subscriptionHostService;

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
     * @param SubscriptionHostServiceInterface $subscriptionHostService
     * @param SubscriptionInvoiceService $subscriptionInvoiceService
     * @param ProductServiceInterface $productService
     */
    public function __construct(InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, SubscriptionHostServiceInterface $subscriptionHostService, SubscriptionInvoiceService $subscriptionInvoiceService, ProductServiceInterface $productService)
    {
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->productService = $productService;
        
        $this->subscriptionHostService = $subscriptionHostService;
        
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
        
        // get product
        $productEntity = $this->productService->get($subscriptionEntity->getProductId());
        
        // if we are host subscription get all hostsand loop through adding invoic Item
        if ($subscriptionEntity->getSubscriptionHost() == 1) {
            $subscriptionHostEntitys = $this->subscriptionHostService->getHostsSubscription($subscriptionEntity->getSubscriptionId());
            
            $subtotal = 0;
            
            // loop though hosts and create item entity
            foreach ($subscriptionHostEntitys as $subscriptionHostEntity) {
                
                $invoiceItemDescrip = $subscriptionHostEntity->getHostEntity()->getHostName() . ' ' . $productEntity->getProductName();
                
                // set Schedule
                if ($subscriptionEntity->getSubscriptionScheduleEntity()->getSubscriptionScheduleName() == 'Monthly') {
                    $invoiceItemAmount = $productEntity->getProductFeeMonthly();
                } elseif ($subscriptionEntity->getSubscriptionScheduleEntity()->getSubscriptionScheduleName() == 'Annual') {
                    $invoiceItemAmount = $productEntity->getProductFeeAnual();
                } else {
                    $invoiceItemAmount = $productEntity->getProductFee();
                }
                
                // create item entity
                $itemEntity = new ItemEntity();
                
                $itemEntity->setInvoiceId($invoiceEntity->getInvoiceId());
                
                $itemEntity->setInvoiceItemAmount($invoiceItemAmount);
                
                $itemEntity->setInvoiceItemDate($subscriptionEntity->getSubscriptionDateDue());
                
                $itemEntity->setInvoiceItemDescrip($invoiceItemDescrip);
                
                $itemEntity->setInvoiceItemId(0);
                
                $itemEntity->setInvoiceItemQty(1);
                
                $itemEntity->setInvoiceItemTotal($invoiceItemAmount);
                
                $this->itemService->save($itemEntity);
                
                $subtotal = $subtotal + $invoiceItemAmount;
            }
        }
        
        // if we are a user subscription the get all users and map invoice item
        
        // if we are just plain subscription service create the invoice item and map
        
        // update invoice totals
        $invoiceEntity->setInvoiceSubtotal($subtotal);
        
        // @todo tax and discount
        
        $invoiceEntity->setInvoiceTotal($subtotal);
        
        $invoiceEntity->setInvoiceBalance($subtotal);
        
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