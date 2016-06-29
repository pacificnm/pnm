<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use AccountLedger\Hydrator\LedgerHydrator;
use AccountLedger\Entity\LedgerEntity;
use Account\Service\AccountServiceInterface;

/**
 * Ledger Form
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class LedgerForm extends Form implements InputFilterProviderInterface
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
     * @return \AccountLedger\Form\LedgerForm
     */
    function __construct(AccountServiceInterface $accountService, $name = 'account-ledger-form', $options = array())
    {
        $this->accountService = $accountService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new LedgerHydrator(false));
        
        $this->setObject(new LedgerEntity());
        
        // fromAccountId
        $this->add(array(
            'name' => 'fromAccountId',
            'type' => 'hidden'
        ));
        
        // accountLedgerId
        $this->add(array(
            'name' => 'accountLedgerId',
            'type' => 'hidden'
        ));
        
        
        
        // accountLedgerBalance
        $this->add(array(
            'name' => 'accountLedgerBalance',
            'type' => 'hidden'
        ));
        
        // accountLedgerCreate
        $this->add(array(
            'name' => 'accountLedgerCreate',
            'type' => 'hidden'
        ));
        
        // accountLedgerType
        $this->add(array(
            'name' => 'accountLedgerType',
            'type' => 'hidden'
        ));
        
        // accountId
        $this->add(array(
            'type' => 'Select',
            'name' => 'accountId',
            'options' => array(
                'label' => 'Pay To:',
                'value_options' => $this->getAccountOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountId'
            )
        ));
        
        
        
        // accountLedgerCreditAmount
        $this->add(array(
            'name' => 'accountLedgerCreditAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountLedgerCreditAmount'
            )
        ));
        
        // accountLedgerDebitAmount
        $this->add(array(
            'name' => 'accountLedgerDebitAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountLedgerDebitAmount'
            )
        ));
        
        // accountLedgerMemo
        $this->add(array(
            'name' => 'accountLedgerMemo',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Memo:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountLedgerMemo'
            )
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
     *
     * {@inheritDoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
    }

    /**
     * Gets account select options
     * 
     * @return array
     */
    private function getAccountOptions()
    {
        $options = array();
        
        $entitys = $this->accountService->getNonSystemAccounts();
        
        foreach ($entitys as $entity) {
            $options[$entity->getAccountId()] = $entity->getAccountName();
        }
        
        return $options;
    }
}

