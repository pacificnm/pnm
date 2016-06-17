<?php
namespace ClientFavorite\Controller;

use Application\Controller\BaseController;
use ClientFavorite\Service\FavoriteServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
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
        
        $favoriteEntitys = $this->favoriteService->getAll(array('authId' => $this->Identity()->getAuthId()));
        
        $this->layout()->setVariable('pageTitle', 'Client Favorites');
        
        $this->layout()->setVariable('pageSubTitle', $this->identity()
            ->getAuthName());
        
        $this->layout()->setVariable('activeMenuItem', 'employee');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-favorite-index');
        
        return new ViewModel(array(
            'favoriteEntitys' => $favoriteEntitys
        )); 
    }
}