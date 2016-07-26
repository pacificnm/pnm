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
        $entity = new HistoryEntity();
        
        $entity->setAuthId($authId);
        $entity->setHistoryAction($action);
        $entity->setHistoryNote($note);
        $entity->setHistoryTime(time());
        $entity->setHistoryUrl($uri);
        
        $historyEntity = $this->historyService->save($entity);
        
        return $historyEntity;
    }
}