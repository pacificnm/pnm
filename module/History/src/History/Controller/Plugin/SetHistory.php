<?php
namespace History\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use History\Service\HistoryServiceInterface;
use History\Entity\HistoryEntity;

class SetHistory extends AbstractPlugin
{
    /**
     * 
     * @var HistoryServiceInterface
     */
    protected $historyService;
    
    /**
     * 
     * @param HistoryServiceInterface $historyService
     */
    public function __construct(HistoryServiceInterface $historyService)
    {
        $this->historyService = $historyService;
    }
    
    /**
     * 
     * @param string $uri
     * @param string $action
     * @param number $authId
     * @param string $note
     */
    public function __invoke($uri, $action, $authId, $note)
    {
        switch($action) {
            case 'READ':
                $entity = new HistoryEntity();
                
                $entity->setAuthId($authId);
                $entity->setHistoryAction('READ');
                $entity->setHistoryNote($note);
                $entity->setHistoryTime(time());
                $entity->setHistoryUrl($uri);
                
                $this->historyService->save($entity);
            break;
        }
        
    }
}