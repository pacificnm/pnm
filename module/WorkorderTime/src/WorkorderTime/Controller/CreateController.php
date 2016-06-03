<?php
namespace WorkorderTime\Controller;

use Application\Controller\BaseController;
use WorkorderTime\Service\TimeServiceInterface;
use WorkorderTime\Form\TimeForm;

class CreateController extends BaseController
{

    /**
     *
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     *
     * @var TimeForm
     */
    protected $timeForm;

    /**
     *
     * @param TimeServiceInterface $timeService            
     * @param TimeForm $timeForm            
     */
    public function __construct(TimeServiceInterface $timeService, TimeForm $timeForm)
    {
        $this->timeService = $timeService;
        
        $this->timeForm = $timeForm;
    }

    public function indexAction()
    {}
}