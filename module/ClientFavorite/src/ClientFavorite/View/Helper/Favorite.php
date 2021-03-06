<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ClientFavorite\Service\FavoriteServiceInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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