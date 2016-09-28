<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace PaymentOption\Controller;

use Application\Controller\BaseController;
use PaymentOption\Service\OptionServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{

    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;

    /**
     *
     * @param OptionServiceInterface $optionService            
     */
    public function __construct(OptionServiceInterface $optionService)
    {
        $this->optionService = $optionService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        $id = $this->params()->fromRoute('paymentOptionId');
        
        $optionEntity = $this->optionService->get($id);
        
        if(! $optionEntity) {
            $this->flashMessenger()->addErrorMessage('Unable to find payment option');
        
            return $this->redirect()->toRoute('payment-option-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            // if yes delete
            if ($del === 'yes') {
                $this->optionService->delete($optionEntity);
                
                $this->flashMessenger()->addSuccessMessage('Deleted Payment Option');
            }
        
            // return to view
            return $this->redirect()->toRoute('payment-option-index');
        }
        
        // set layout vars
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'payment-option-index');
        
        // return view model
        return new ViewModel(array(
            'optionEntity' => $optionEntity
        ));
    }
}