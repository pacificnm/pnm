<?php
namespace Cron\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Cron\Hydrator\CronHydrator;
use Cron\Entity\CronEntity;


class CronForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     */
    public function __construct($name = 'cron-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new CronHydrator(false));
        
        $this->setObject(new CronEntity());
        
        // cronId
        $this->add(array(
            'name' => 'cronId',
            'type' => 'hidden'
        ));
        
        // cronMinute
        $this->add(array(
            'type' => 'Select',
            'name' => 'cronMinute',
            'options' => array(
                'label' => 'Minute:',
                'value_options' => $this->getMinute()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'cronMinute'
            )
        ));
        
        // cronHour
        $this->add(array(
            'type' => 'Select',
            'name' => 'cronHour',
            'options' => array(
                'label' => 'Hour:',
                'value_options' => $this->getHour()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'cronHour'
            )
        ));
        
        // cronDom
        $this->add(array(
            'type' => 'Select',
            'name' => 'cronDom',
            'options' => array(
                'label' => 'Day Of Month:',
                'value_options' => $this->getDom()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'cronDom'
            )
        ));
        
        // cronMonth
        $this->add(array(
            'type' => 'Select',
            'name' => 'cronMonth',
            'options' => array(
                'label' => 'Month:',
                'value_options' => $this->getMonth()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'cronMonth'
            )
        ));
        
        // cronCommand
        $this->add(array(
            'name' => 'cronCommand',
            'type' => 'Text',
            'options' => array(
                'label' => 'Command:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'cronCommand'
            )
        ));
        
        // cronRunOnce
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'cronRunOnce',
            'options' => array(
                'label' => 'Run Once',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        
        // cronLastRun
        $this->add(array(
            'name' => 'cronLastRun',
            'type' => 'hidden'
        ));
        
        // cronEnabled
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'cronEnabled',
            'options' => array(
                'label' => 'Enabled',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // cronId
            
            // cronMinute
            
            // cronHour
            
            // cronDom
            
            // cronMonth
            
            // cronCommand
            
            // cronRunOnce
            
            // cronLastRun
            
            // cronEnabled
        );
    }

    protected function getMinute()
    {
        $array = array();
        
        for ($i = 0; $i < 60; $i++) {
            $array[$i] = $i;
        }
        
        return $array;
    }
    
    protected function getHour()
    {
        $array = array();
        
        for ($i = 0; $i < 24; $i++) {
            $array[$i] = $i;
        }
        
        return $array;
    }
    
    protected function getDom()
    {
        $array = array();
        
        for ($i = 0; $i < 31; $i++) {
            $array[$i] = $i;
        }
        
        return $array;
    }
    
    protected function getMonth()
    {
        $array = array();
        
        for ($i = 0; $i < 13; $i++) {
            $array[$i] = $i;
        }
        
        return $array;
    }
}