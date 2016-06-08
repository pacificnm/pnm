<?php
namespace ClientFavorite\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ClientFavorite\Service\FavoriteServiceInterface;

class Favorite extends AbstractHelper
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

    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $favoriteEntitys = $this->favoriteService->getAll(array('authId' => $view->Identity()->getAuthId()));
        
        $data = new \stdClass();
        $data->favoriteEntitys = $favoriteEntitys;
        
        return $partialHelper('partials/favorite.phtml', $data);
    }
}