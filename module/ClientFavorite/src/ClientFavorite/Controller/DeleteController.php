<?php
namespace ClientFavorite\Controller;

use Application\Controller\BaseController;
use ClientFavorite\Service\FavoriteServiceInterface;

class DeleteController extends BaseController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
    
    }
}