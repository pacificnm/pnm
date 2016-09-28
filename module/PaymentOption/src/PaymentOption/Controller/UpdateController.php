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
use PaymentOption\Form\OptionForm;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{

    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;

    /**
     *
     * @var OptionForm
     */
    protected $optionForm;

    /**
     *
     * @param OptionServiceInterface $optionService            
     * @param OptionForm $optionForm            
     */
    public function __construct(OptionServiceInterface $optionService, OptionForm $optionForm)
    {
        $this->optionService = $optionService;
        
        $this->optionForm = $optionForm;
    }

    /**
     * 
     * {@inheritDoc}
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
            // get post
            $postData = $request->getPost();
        
            $this->optionForm->setData($postData);
        
            // if we are valid
            if ($this->optionForm->isValid()) {
                $entity = $this->optionForm->getData();
        
                $optionEntity = $this->optionService->save($entity);
        
                $this->flashMessenger()->addSuccessMessage('The payment option was saved.');
        
                return $this->redirect()->toRoute('payment-option-index');
            }
        }
        
        // bind the form
        $this->optionForm->bind($optionEntity);
        
        // set layout vars
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'payment-option-index');
        
        // return view model
        return new ViewModel(array(
            'form' => $this->optionForm
        ));
    }
}
