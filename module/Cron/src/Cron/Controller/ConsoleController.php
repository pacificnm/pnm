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
     * @var number
     */
    protected $minute;
    
    /**
     * 
     * @var number
     */
    protected $hour;
    
    /**
     * 
     * @var number
     */
    protected $day;
    
    /**
     * 
     * @var number
     */
    protected $mon;
    
    /**
     * 
     * @var number
     */
    protected $dow;
    
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
        
        // get the time and break it up into something we can querry on
        $this->minute = date("i", time());
        
        $this->hour = date("h", time());
        
        $this->day = date("d", time());
        
        $this->mon = date("m", time());
        
        $this->dow = date("w", time());
    }

    /**
     *
     * {@inheritDoc}
     *
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
        
        // grab all run once and do them first.
        $cronEnititys = $this->cronService->getRunOnce();
        
        $this->runCronJobs($cronEnititys);
        
        
        // grab for this current min
        $cronEnititys = $this->cronService->getByTime($this->minute, 0, 0, 0, 0);
        
        $this->runCronJobs($cronEnititys);
        
        
        //grab for top of the hour
        $cronEnititys = $this->cronService->getByTime(0, $this->hour, 0, 0, 0);
        
        $this->runCronJobs($cronEnititys);
        
        // grab for current min and hour
        $cronEnititys = $this->cronService->getByTime($this->minute, $this->hour, 0, 0, 0);
        
        $this->runCronJobs($cronEnititys);
        
        // grab for top of day
        $cronEnititys = $this->cronService->getByTime(0, 0, $this->day, 0, 0);
        
        // grab for current min and hour and day
        $cronEnititys = $this->cronService->getByTime($this->minute, $this->hour, $this->day, 0, 0);
        
        $this->runCronJobs($cronEnititys);
        
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

    public function runningAction()
    {
        // validate we are in a console
        if (! $this->request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($this->request));
        }
        
        $start = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron Running {$start}\n", 3);
        
        $this->logService->info("Cron Running Ran {$start}");
        
        // start
        
        
        
        // end
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron Running Completed {$end}\n", 3);
        
        $this->logService->info("Cron Running Completed {$end}");
    }
    
    public function killAction()
    {
        // validate we are in a console
        if (! $this->request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($this->request));
        }
        
        $pid = $this->params('pid');
        
        if(! $pid) {
            throw new RuntimeException('Missing required param');
        }
        
        $start = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron Kill {$start} PID {$pid}\n", 3);
        
        $this->logService->info("Cron Kill Ran {$start} PID {$pid}");
        
        // start
        // look up PID in database otherwise do nothing. we only kill existing pid thats match to our service.
        // If the pid is not in the table then we need a human to look at and kill it. 
        
        
        // end
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Cron Kill Completed {$end} PID {$pid}\n", 3);
        
        $this->logService->info("Cron Kill Completed {$end} PID {$pid}");
    }
    
    protected function runCronJobs($cronEnititys)
    {
        foreach($cronEnititys as $cronEnitity) {
            $this->console->write("Start {$cronEnitity->getCronCommand()}\n", 3);
        
            $this->logService->info("Start {$cronEnitity->getCronCommand()}");
        
            $cronEnitity->setCronLastRun(time());
        
            $cronEnitity->setCronStatus(1);
        
            $cronEnitity = $this->cronService->save($cronEnitity);
        
            $cmd =  getcwd() . '/bin/' . $cronEnitity->getCronCommand();
        
            try {
                exec($cmd);
            } catch (\Exception $e) {
                $this->console->write("Failed to run {$cronEnitity->getCronCommand()} Error: {$e->getMessage()}\n", 2);
        
                $this->logService->err("Failed to run {$cronEnitity->getCronCommand()} Error: {$e->getMessage()}");
        
                $cronEnitity->setCronEnabled(0);
        
                $cronEnitity = $this->cronService->save($cronEnitity);
        
                continue;
            }
        
            // set runOce to off and enabled to off
            $cronEnitity->setCronEnabled(0);
        
            $cronEnitity = $this->cronService->save($cronEnitity);
        
            // trigger event
            $this->logService->info("End {$cronEnitity->getCronCommand()}");
        
        }
    }
}
