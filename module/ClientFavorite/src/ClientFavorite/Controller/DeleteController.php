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
        $id = $this->params()->fromRoute('clientFavoriteId');
        
        $favoriteEntity = $this->favoriteService->get($id);
        
        if($favoriteEntity->getAuthId() != $this->identity()->getAuthId()) {
            $this->flashmessenger()->addErrorMessage('You dont own this favorite.');
            
            return $this->redirect()->toRoute('employee-profile');
        }
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                $this->favoriteService->delete($favoriteEntity);
        
                $this->flashmessenger()->addSuccessMessage('The favorite was deleted');
        
                return $this->redirect()->toRoute('employee-profile');
            }
        
            // return to view
            return $this->redirect()->toRoute('client-favorite-index', array(
                'laborId' => $id
            ));
        }
        
        $this->layout()->setVariable('pageTitle', 'Client Favorites');
        
        $this->layout()->setVariable('pageSubTitle', $this->identity()
            ->getAuthName());
        
        $this->layout()->setVariable('activeMenuItem', 'employee');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-favorite-index');
        
        return new ViewModel(array(
            'favoriteEntity' => $favoriteEntity
        ));
    }
}