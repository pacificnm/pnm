<?php
namespace ClientFavorite\Controller;

use Application\Controller\BaseController;
use ClientFavorite\Service\FavoriteServiceInterface;
use ClientFavorite\Entity\FavoriteEntity;

class CreateController extends BaseController
{

    /**
     *
     * @var FavoriteServiceInterface
     */
    protected $favoriteService;

    /**
     *
     * @param FavoriteServiceInterface $favoriteService            
     */
    public function __construct(FavoriteServiceInterface $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $entity = new FavoriteEntity();
        
        $entity->setAuthId($this->identity()
            ->getAuthId());
        
        $entity->setClientFavoriteTime(time());
        
        $entity->setClientId($clientId);
        
        $entity = $this->favoriteService->save($entity);
        
        $this->flashmessenger()->addSuccessMessage('Client was added to your favorites.');
        
        return $this->redirect()->toRoute('client-view', array(
            'clientId' => $clientId
        ));
    }
}