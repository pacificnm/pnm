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
use Zend\View\Model\ViewModel;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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