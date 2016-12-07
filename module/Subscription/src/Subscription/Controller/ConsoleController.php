<?php
namespace Subscription\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use Subscription\Service\SubscriptionServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use RuntimeException;
use SubscriptionProduct\Service\SubscriptionProductServiceInterface;
use Invoice\Entity\InvoiceEntity;
use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;
use SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface;
use InvoiceItem\Entity\ItemEntity;
use Product\Entity\ProductEntity;

class ConsoleController extends AbstractActionController
{

    /**
     *
     * @var SubscriptionServiceInterface
     */
    protected $service;

    /**
     *
     * @var SubscriptionProductServiceInterface
     */
    protected $subscriptionProductService;

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
     * @var Logger
     */
    protected $logService;

    /**
     *
     * @var Stream
     */
    protected $writerService;

    /**
     *
     * @param SubscriptionServiceInterface $service            
     * @param SubscriptionProductServiceInterface $subscriptionProductService            
     * @param SubscriptionInvoiceServiceInterface $subscriptionInvoiceService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param ItemServiceInterface $itemService            
     */
    public function __construct(SubscriptionServiceInterface $service, SubscriptionProductServiceInterface $subscriptionProductService, SubscriptionInvoiceServiceInterface $subscriptionInvoiceService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService)
    {
        $this->service = $service;
        
        $this->subscriptionProductService = $subscriptionProductService;
        
        $this->subscriptionInvoiceService = $subscriptionInvoiceService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->logService = new Logger();
        
        $this->writerService = new Stream('./data/log/' . date('Y-m-d') . '-subscription.log');
        
        $this->logService->addWriter($this->writerService);
    }

    /**
     * Invoice sActions
     *
     * @throws RuntimeException
     */
    public function invoiceAction()
    {
        // load request
        $request = $this->getRequest();
        
        // validate we are in a console
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($request));
        }
        
        // load console
        $console = $this->getServiceLocator()->get('console');
        
        $start = date('m/d/Y h:i a', time());
        
        $console->write("Start subscription invoice at {$start}\n", 3);
        
        $this->logService->info("Start subscription invoices at {$start}");
        
        $subscriptionDateDue = mktime(0, 0, 0, date("m", time()), date("d", time()), date("y", time()));
        
        // get due subscriptions
        $entitys = $this->service->getDue($subscriptionDateDue);
        
        if ($entitys->count() == 0) {
            $console->write("No due subscriptions\n", 3);
            
            $this->logService->info("No due subscriptions");
        } else {
            $count = $entitys->count();
            
            $console->write("Found {$count} subscriptions due.\n", 3);
            
            $this->logService->info("Found {$count} subscriptions due.");
            
            // loop through each subscription
            foreach ($entitys as $entity) {
                $console->write("Working on subscription {$entity->getSubscriptionId()}.\n", 3);
                
                $this->logService->info("Working on subscription {$entity->getSubscriptionId()}.");
                
                // get subscription products
                $productEntitys = $this->subscriptionProductService->getSubscriptionProducts($entity->getSubscriptionId());
                
                $console->write("Found {$productEntitys->count()} products.\n", 3);
                
                $this->logService->info("Found {$productEntitys->count()} products.");
                
                // create invoice
                $invoiceDate = mktime(0, 0, 0, date("m", time()), date("d", time()), date("Y", time()));
                
                $invoiceEntity = $this->createInvoice($entity->getSubscriptionId(), $entity->getClientId(), $invoiceDate, $invoiceDate, $invoiceDate);
                
                $invoiceTotal = 0;
                
                // loop though each product and add invoice Item
                foreach ($productEntitys as $productEntity) {
                    
                    $invoiceItemAmount = $this->getProductPrice($productEntity->getProductEntity()) * $productEntity->getSubscriptionProductQty();
                    
                    $itemEntity = $this->createInvoiceItem($invoiceEntity->getInvoiceId(), $invoiceItemAmount, $productEntity->getProductEntity()->getProductName(), $productEntity->getSubscriptionProductQty());
                 
                    $invoiceTotal = $invoiceTotal + $invoiceItemAmount;
                }
                
                // update invoice totals
                $this->invoiceService->updateInvoiceTotals($invoiceEntity, $invoiceTotal);
                
                $console->write("Completed subscription {$entity->getSubscriptionId()}.\n", 3);
                
                $this->logService->info("Completed subscription {$entity->getSubscriptionId()}.");
            }
        }
        
        // done
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Completed subscription invoice at {$end}\n", 3);
        
        $this->logService->info("Completed subscription invoice at {$end}");
    }

    /**
     * Auto Suspend Action
     *
     * @throws RuntimeException
     */
    public function suspendAction()
    {
        // load request
        $request = $this->getRequest();
        
        // validate we are in a console
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($request));
        }
        
        // load console
        $console = $this->getServiceLocator()->get('console');
        
        $start = date('m/d/Y h:i a', time());
        
        $console->write("Start subscription auto suspend at {$start}\n", 3);
        
        $this->logService->info("Start subscription auto suspend at {$start}");
        
        // done
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Completed subscription auto suspend at {$end}\n", 3);
        
        $this->logService->info("Completed subscription auto suspend at {$end}");
    }

    /**
     *
     * @param number $subscriptionId            
     * @param number $clientId            
     * @param number $invoiceDate            
     * @param number $invoiceDateStart            
     * @param number $invoiceDateEnd            
     * @return \Invoice\Entity\InvoiceEntity
     */
    protected function createInvoice($subscriptionId, $clientId, $invoiceDate, $invoiceDateStart, $invoiceDateEnd)
    {
        $entity = new InvoiceEntity();
        
        $entity->setClientId($clientId);
        
        $entity->setInvoiceBalance(0);
        
        $entity->setInvoiceDate($invoiceDate);
        
        $entity->setInvoiceDateEnd($invoiceDateEnd);
        
        $entity->setInvoiceDatePaid(0);
        
        $entity->setInvoiceDateStart($invoiceDateStart);
        
        $entity->setInvoiceDiscount(0);
        
        $entity->setInvoiceId(0);
        
        $entity->setInvoicePayment(0);
        
        $entity->setInvoiceStatus('Un-Paid');
        
        $entity->setInvoiceSubtotal(0);
        
        $entity->setInvoiceTax(0);
        
        $entity->setInvoiceTotal(0);
        
        $invoiceEntity = $this->invoiceService->save($entity);
        
        // map invoice to subscription
        $subscriptionInvoiceEntity = new SubscriptionInvoiceEntity();
        
        $subscriptionInvoiceEntity->setInvoiceId($invoiceEntity->getInvoiceId());
        
        $subscriptionInvoiceEntity->setSubscriptionId($subscriptionId);
        
        $subscriptionInvoiceEntity = $this->subscriptionInvoiceService->save($subscriptionInvoiceEntity);
        
        return $invoiceEntity;
    }

    /**
     *
     * @param number $invoiceId            
     * @param float $invoiceItemAmount            
     * @param string $invoiceItemDescrip            
     * @param number $invoiceItemQty            
     * @return \InvoiceItem\Entity\ItemEntity
     */
    protected function createInvoiceItem($invoiceId, $invoiceItemAmount, $invoiceItemDescrip, $invoiceItemQty)
    {
        $invoiceItemTotal = $invoiceItemAmount * $invoiceItemQty;
        
        $invoiceItemDate = mktime(0, 0, 0, date("m", time()), date("d", time()), date("Y", time()));
        
        $entity = new ItemEntity();
        
        $entity->setInvoiceId($invoiceId);
        
        $entity->setInvoiceItemAmount($invoiceItemAmount);
        
        $entity->setInvoiceItemDate($invoiceItemDate);
        
        $entity->setInvoiceItemDescrip($invoiceItemDescrip);
        
        $entity->setInvoiceItemQty($invoiceItemQty);
        
        $entity->setInvoiceItemTotal($invoiceItemTotal);
        
        $itemEntity = $this->itemService->save($entity);
        
        return $itemEntity;
    }
    
    /**
     * 
     * @param ProductEntity $productEntity
     * @return number|\Product\Entity\the
     */
    protected function getProductPrice(ProductEntity $productEntity)
    {
        $invoiceItemAmount = 0;
        
        if($productEntity->getProductFeeMonthly()) {
            $invoiceItemAmount = $productEntity->getProductFeeMonthly();
        } elseif($productEntity->getProductFeeAnual()) {
            $invoiceItemAmount = $productEntity->getProductFeeAnual();
        } else {
            $invoiceItemAmount = $productEntity->getProductFee();
        }
        
        return $invoiceItemAmount;
    }
    
    
}