<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\Controller;

use Application\Controller\BaseController;
use ClientFavorite\Service\FavoriteServiceInterface;
use ClientFavorite\Entity\FavoriteEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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