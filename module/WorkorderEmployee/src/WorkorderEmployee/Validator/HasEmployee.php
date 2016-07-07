<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderEmployee\Validator;

use Zend\Validator\AbstractValidator;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class HasEmployee extends AbstractValidator
{

    const HAS_EMPLOYEE = 'This work order already has the employee assigned.';

    /**
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::HAS_EMPLOYEE => "This work order already has the employee assigned."
    );

    /**
     *
     * @var WorkorderEmployeeServiceInterface
     */
    protected $employeeService;

    /**
     * 
     * @param array $options
     */
    public function __construct(array $options = null)
    {
        parent::__construct($options);
        
        $this->employeeService = $options['employeeService'];
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Validator\ValidatorInterface::isValid()
     */
    public function isValid($value, $context = null)
    {
        $this->setValue($value);
        
        // from form
        $workorderId = $context['workorderId'];
        
        // get from service
        $employeeEntity = $this->employeeService->getEmployeeWorkorder($value, $workorderId);
        
        if (! $employeeEntity) {
            $isValid = true;
        } else {
            $isValid = false;
            $this->error(self::HAS_EMPLOYEE);
        }
        
        return $isValid;
    }
}
