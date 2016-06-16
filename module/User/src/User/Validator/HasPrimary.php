<?php
namespace User\Validator;

use Zend\Validator\AbstractValidator;
use User\Service\UserServiceInterface;

class HasPrimary extends AbstractValidator
{
    const HAS_PRIMARY = 'This client already has a Primary User';
    
    /**
     * 
     * @var UserServiceInterface
     */
    protected $userService;
    
    /**
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::HAS_PRIMARY => "This client already has a Primary User"
    );
    
    /**
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        parent::__construct($options);
    
        $this->userService = $options['userService'];
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Validator\ValidatorInterface::isValid()
     */
    public function isValid($value, $context = null)
    {
        if($context['userType'] != 'Primary') {
            $isValid = true;
            return $isValid;
        }
        
        $clientId = $context['clientId'];
        
        $this->setValue($value);
        
        $userEntity = $this->userService->getClientPrimaryUser($clientId);
        
        if(! $userEntity) {
            $isValid = true;
            return $isValid;
        } else {
            if($userEntity->getUserNameFirst() == $context['userNameFirst'] && $userEntity->getUserNameLast() == $context['userNameLast']) {
                $isValid = true;
            } else {
                $isValid = false;
                $this->error(self::HAS_PRIMARY);
            }
        }
        
        return $isValid;
    }
}
