<?php
namespace SubscriptionProduct\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Subscription\Service\SubscriptionServiceInterface;
use SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Entity\ItemEntity;

class SubscriptionProductListener implements ListenerAggregateInterface
{

    /**
     *
     * @var array
     */
    protected $listeners = array();

    /**
     *
     * @var SubscriptionServiceInterface
     */
    protected $subscriptionService;

    /**
     *
     * @var SubscriptionInvoiceServiceInterface
     */
    protected $subscriptionInvoiceService;

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
     * @param SubscriptionServiceInterface $subscriptionService
     * @param SubscriptionInvoiceServiceInterface $subscriptionInvoiceService
     * @param InvoiceServiceInterface $invoiceService
     * @param ItemServiceInterface $itemService
     */
    public function __construct(SubscriptionServiceInterface $subscriptionService, SubscriptionInvoiceServiceInterface $subscriptionInvoiceService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService)
    {
        $this->subscriptionService = $subscriptionService;
        
        $this->subscriptionInvoiceService = $subscriptionInvoiceService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
    }

    public function subscriptionProductCreate(EventInterface $event)
    {
        $entity = $event->getParam('subscriptionProductEntity');
        
        $productEntity = $entity->getProductEntity();
        
        $subscriptionInvoiceEntity = $this->subscriptionInvoiceService->getBySubcription($entity->getSubscriptionId());
        
        $invoiceEntity = $subscriptionInvoiceEntity->getInvoiceEntity();
        
        $subscriptionEntity = $subscriptionInvoiceEntity->getSubscriptionEntity();
        
        if($subscriptionEntity->getSubscriptionScheduleId() == 1) {
            $invoiceItemAmount = $productEntity->getProductFeeMonthly();
        } else {
            $invoiceItemAmount = $productEntity->getProductFeeAnual();
        }
        
        $invoiceItemTotal = $invoiceItemAmount * $entity->getSubscriptionProductQty();
        
        // create invoice Items
        $invoiceItem = new ItemEntity();
        
        $invoiceItem->setInvoiceId($invoiceEntity->getInvoiceId());
        $invoiceItem->setInvoiceItemAmount($invoiceItemAmount);
        $invoiceItem->setInvoiceItemDate($subscriptionEntity->getSubscriptionDateDue());
        $invoiceItem->setInvoiceItemDescrip($productEntity->getProductName());
        $invoiceItem->setInvoiceItemQty($entity->getSubscriptionProductQty());
        $invoiceItem->setInvoiceItemTotal($invoiceItemTotal);

        $this->itemService->save($invoiceItem);
        
        // update invoice totals
        $invoiceEntity->setInvoiceSubtotal($invoiceEntity->getInvoiceSubtotal() + $invoiceItemTotal);
        
        $invoiceEntity->setInvoiceTotal($invoiceEntity->getInvoiceTotal() + $invoiceItemTotal);
        
        $invoiceEntity->setInvoiceBalance($invoiceEntity->getInvoiceBalance() + $invoiceItemTotal);
        
        $this->invoiceService->save($invoiceEntity);
        
    }

    /**
     * 
     * @param EventInterface $event
     */
    public function subscriptionProductUpdate(EventInterface $event)
    {
        $entity = $event->getParam('subscriptionProductEntity');
        
        $productEntity = $entity->getProductEntity();
        
        $subscriptionInvoiceEntity = $this->subscriptionInvoiceService->getBySubcription($entity->getSubscriptionId());
        
        $invoiceEntity = $subscriptionInvoiceEntity->getInvoiceEntity();
        
        $subscriptionEntity = $subscriptionInvoiceEntity->getSubscriptionEntity();
        
        if($subscriptionEntity->getSubscriptionScheduleId() == 1) {
            $invoiceItemAmount = $productEntity->getProductFeeMonthly();
        } else {
            $invoiceItemAmount = $productEntity->getProductFeeAnual();
        }
        
        $invoiceItemTotal = $invoiceItemAmount * $entity->getSubscriptionProductQty();
        
        // create invoice Items
        $invoiceItem = new ItemEntity();
        
        $invoiceItem->setInvoiceId($invoiceEntity->getInvoiceId());
        $invoiceItem->setInvoiceItemAmount($invoiceItemAmount);
        $invoiceItem->setInvoiceItemDate($subscriptionEntity->getSubscriptionDateDue());
        $invoiceItem->setInvoiceItemDescrip($productEntity->getProductName());
        $invoiceItem->setInvoiceItemQty($entity->getSubscriptionProductQty());
        $invoiceItem->setInvoiceItemTotal($invoiceItemTotal);
        
        $this->itemService->save($invoiceItem);
        
        // update invoice totals
        $invoiceEntity->setInvoiceSubtotal($invoiceEntity->getInvoiceSubtotal() + $invoiceItemTotal);
        
        $invoiceEntity->setInvoiceTotal($invoiceEntity->getInvoiceTotal() + $invoiceItemTotal);
        
        $invoiceEntity->setInvoiceBalance($invoiceEntity->getInvoiceBalance() + $invoiceItemTotal);
        
        $this->invoiceService->save($invoiceEntity);
        
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
    {
        $this->listeners = array(
            $events->attach('subscriptionProductCreate', array(
                $this,
                'subscriptionProductCreate'
            )),
            $events->attach('subscriptionProductUpdate', array(
                $this,
                'subscriptionProductUpdate'
            ))
        );
        
        return $this;
    }

    /**
     *
     * {@inheritdoc}
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

