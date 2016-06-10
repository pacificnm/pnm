<?php
namespace WorkorderNote\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderNote\Service\NoteServiceInterface;
use Workorder\Entity\WorkorderEntity;

class GetWorkorderNotes extends AbstractHelper
{

    /**
     *
     * @var NoteServiceInterface
     */
    protected $noteService;

    /**
     *
     * @param NoteServiceInterface $noteService            
     */
    public function __construct(NoteServiceInterface $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     * 
     * @param WorkorderEntity $workorderEntity
     * @param string $displayLinks
     */
    public function __invoke(WorkorderEntity $workorderEntity, $displayLinks = true)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data  = new \stdClass();
        
        $noteEntitys = $this->noteService->getWorkorderNotes($workorderEntity->getWorkorderId());
        
        $data->noteEntitys = $noteEntitys;
        
        $data->workorderEntity = $workorderEntity;
        
        $data->displayLinks = $displayLinks;
        
        return $partialHelper('partials/get-workorder-notes.phtml', $data);
    }
}
