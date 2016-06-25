<?php
namespace VendorPayment\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use VendorPayment\Hydrator\PaymentHydrator;
use VendorPayment\Entity\PaymentEntity;
use Account\Service\AccountServiceInterface;

class PaymentForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var AccountServiceInterface
     */
    protected $accountService;
    
    /**
     * 
     * @param AccountServiceInterface $accountService
     * @param string $name
     * @param array $options
     * @return \VendorPayment\Form\PaymentForm
     */
    function __construct(AccountServiceInterface $accountService, $name = 'vendor-payment-form', $options = array())
    {
        $this->accountService = $accountService;
        
        parent::__construct($name, $options);
    
        $this->setHydrator(new PaymentHydrator(false));
    
        $this->setObject(new PaymentEntity());
    
        // vendorPaymentId
        $this->add(array(
            'name' => 'vendorPaymentId',
            'type' => 'hidden'
        ));
        
        // vendorId
        $this->add(array(
            'name' => 'vendorId',
            'type' => 'hidden'
        ));
        
        // vendorBillId
        $this->add(array(
            'name' => 'vendorBillId',
            'type' => 'hidden'
        ));
        
        // accountId
        $this->add(array(
            'type' => 'Select',
            'name' => 'accountId',
            'options' => array(
                'label' => 'Pay From:',
                'value_options' => $this->getAccountOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountId'
            )
        ));
        
        // vendorPaymentAmount
        $this->add(array(
            'name' => 'vendorPaymentAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Payment Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorPaymentAmount'
            )
        ));
        
        // accountLedgerId
        $this->add(array(
            'name' => 'accountLedgerId',
            'type' => 'hidden'
        ));
        
        // vendorPaymentDate
        $this->add(array(
            'name' => 'vendorPaymentDate',
            'type' => 'Text',
            'options' => array(
                'label' => 'Payment Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorPaymentDate'
            )
        ));
        
        
        // vendorPaymentActive
        $this->add(array(
            'name' => 'vendorPaymentActive',
            'type' => 'hidden'
        ));
        
        // button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
        
        return $this;
        
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // vendorPaymentId
            
            // vendorId
            
            // vendorBillId
            
            // accountId
            
            // accountLedgerId
            
            // vendorPaymentDate
            
            // vendorPaymentActive
        );
        
    }
    
    private function getAccountOptions()
    {
        $options = array();
        
        $entitys = $this->accountService->getNonSystemAccounts();
        
        $options[0] = 'No Payment';
        
        foreach($entitys as $entity) {
            $options[$entity->getAccountId()] = $entity->getAccountName();
        }
        
        return $options;
    }

}