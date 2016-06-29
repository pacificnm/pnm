<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Controller;

use Application\Controller\BaseController;
use Account\Service\AccountServiceInterface;
use Zend\View\Model\ViewModel;

/**
 *
 * @author jaimie
 *        
 */
class DeleteController extends BaseController
{

    /**
     *
     * @var AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @param AccountServiceInterface $accountService            
     */
    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // account id
        $id = $this->params()->fromRoute('accountId');
        
        // get account entity
        $accountEntity = $this->accountService->get($id);
        
        // validate we got one
        if (! $accountEntity) {
            $this->flashMessenger()->addErrorMessage('The account was not found');
            
            return $this->redirect()->toRoute('account-index');
        }
        
        // request object
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $accountEntity->setAccountActive(0);
                
                $this->accountService->save($accountEntity);
                
                $this->flashmessenger()->addSuccessMessage('The account was deleted');
                
                return $this->redirect()->toRoute('account-index');
            }
            
            return $this->redirect()->toRoute('account-view', array(
                'accountId' => $id
            ));
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Accounts');
        
        $this->layout()->setVariable('pageSubTitle', 'Delete');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-index');
        
        return new ViewModel(array(
            'accountEntity' => $accountEntity
        ));
    }
}