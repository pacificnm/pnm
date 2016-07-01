<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Location\Validator;

use Zend\Validator\AbstractValidator;
use Location\Service\LocationServiceInterface;

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class HasPrimary extends AbstractValidator
{
    const HAS_PRIMARY = 'This client already has a Primary Location';
    
    /**
     * 
     * @var LocationServiceInterface
     */
    protected $locationService;

    
    /**
     * 
     * @var array
     */
    protected $messageTemplates = array(
        self::HAS_PRIMARY => "This client already has a Primary Location"
    );

    /**
     * 
     * @param array $options
     */
    public function __construct($options = null)
    {
        parent::__construct($options);
    
        $this->locationService = $options['locationService'];
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Validator\ValidatorInterface::isValid()
     */
    public function isValid($value, $context = null)
    {
        
        if($context['locationType'] != 'Primary') {
            $isValid = true;
            return $isValid;
        }
        
        $clientId = $context['clientId'];
        
        $locationStreet = $context['locationStreet'];
        
        $this->setValue($value);
        
        $locationEntity = $this->locationService->getClientLocationByType($clientId, 'Primary');
        
        if(! $locationEntity) {
            $isValid = true;
        } else {
            if($locationEntity->getLocationStreet() == $locationStreet) {
                $isValid = true;
            } else {
                $isValid = false;
                $this->error(self::HAS_PRIMARY);
            }
        } 
        
        return $isValid;
    }
}
