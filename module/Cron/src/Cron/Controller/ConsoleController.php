<?php
namespace Cron\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Cron\Service\CronServiceInterface;
use Zend\Log\Writer\Stream;
use Zend\Log\Logger;

class ConsoleController extends AbstractActionController
{
    /**
     * 
     * @var CronServiceInterface
     */
    protected $cronService;
    
    protected $logService;
    
    protected $writerService;
    
    protected $console;
    
    protected $request;
    
    /**
     * 
     * @param CronServiceInterface $cronService
     */
    public function __construct(CronServiceInterface $cronService, Console $console)
    {
        $this->cronService = $cronService;
        
        $this->console = $console;
        
        $this->logService = new Logger();
        
        $this->writerService = new Stream('./data/log/' . date('Y-m-d') . '-cron.log');
        
        $this->logService->addWriter($this->writerService);
        
        $this->request = $this->getRequest();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        
        // validate we are in a console
        if (! $this->request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($this->request));
        }
        
                
        $start = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron started {$start}\n", 3);
        
        $this->logService->info("Cron started {$start}");
        
        // start
        
        
        // end
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron Completed {$end}\n", 3);
        
        $this->logService->info("Cron Completed {$end}");
    }
    
    
    public function listAction()
    {
        // validate we are in a console
        if (! $this->request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($this->request));
        }
        
        
        $start = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron List {$start}\n", 3);
        
        $this->logService->info("Cron List Ran {$start}");
        
        // start
        
        
        // end
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron List Completed {$end}\n", 3);
        
        $this->logService->info("Cron List Completed {$end}");
    }
}
