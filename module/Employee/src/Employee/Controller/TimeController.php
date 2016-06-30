<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Controller;

use Application\Controller\BaseController;
use WorkorderTime\Service\TimeServiceInterface;
use Zend\View\Model\ViewModel;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class TimeController extends BaseController
{
    /**
     * 
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     * 
     * @param TimeServiceInterface $timeService
     */
    public function __construct(TimeServiceInterface $timeService)
    {
        $this->timeService = $timeService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $start = null;
        
        $end = null;
        
        // the page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page set to 31 to display a full month
        $countPerPage = $this->params()->fromQuery('count-per-page', 31);
        
        // from the form
        $workorderTimeIn = $this->params()->fromQuery('workorderTimeIn', null);
        if(! empty($workorderTimeIn)) {
            $timePieces = explode('-', $workorderTimeIn);
            if(count($timePieces) == 2) {
                $start = $timePieces[0];
                
                $end = $timePieces[1];
            }
        }
        
        // start date defaults to the first day of this month
        if(empty($start)) {
            $start = $this->params()->fromQuery('start', date("m/d/Y", mktime(0,0,0, date("m"), 1, date("Y"))));
        }
        
        // end date defaults to the last day of this month
        if(empty($end)) {
            $end = $this->params()->fromQuery('end', date("m/d/Y", mktime(0,0,0, date("m"), date("t"), date("Y"))));
        }
        
        // get paginator
        $paginator = $this->timeService->getEmployeeTime($this->identity()->getEmployeeId(), strtotime($start), strtotime($end));
        
        // set current page
        $paginator->setCurrentPageNumber($page);
        
        // set items per page
        $paginator->setItemCountPerPage($countPerPage);
        
        // get total time for range selected
        $totalTime = $this->timeService->getEmployeeTotalTime($this->identity()->getEmployeeId(), strtotime($start), strtotime($end));
        
        // set pageTitle
        $this->layout()->setVariable('pageTitle', 'Time Clock');
        
        // return view model
        return new ViewModel(array(
            'start' => $start,
            'end' => $end,
            'totalTime' => $totalTime,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(),
        ));
    }
}
