<?php
namespace Auth\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Auth\Service\AuthServiceInterface;

class AuthAdapter implements AdapterInterface
{

    /**
     *
     * @var string
     */
    protected $authEmail;

    /**
     *
     * @var string
     */
    protected $authPassword;

    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     *
     * @param AuthServiceInterface $authService            
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Authentication\Adapter\AdapterInterface::authenticate()
     */
    public function authenticate()
    {
        $bcrypt = new Bcrypt();
        
        $authEntity = $this->authService->getAuthByEmail($this->authEmail);
        
        if ($bcrypt->verify($this->authPassword, $authEntity->getAuthPassword())) {
            return new Result(Result::SUCCESS, $authEntity);
        }
        
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, 'Invalid Username / Password combination.', array());
    }

    /**
     *
     * @param string $authEmail            
     */
    public function setIdentity($authEmail)
    {
        $this->authEmail = $authEmail;
    }

    /**
     *
     * @param string $authPassword            
     */
    public function setCredential($authPassword)
    {
        $this->authPassword = $authPassword;
    }

    /**
     *
     * @param unknown $type            
     * @param unknown $identity            
     * @param unknown $message            
     */
    private function getResult($type, $identity, $message)
    {
        return new Result($type, $identity, array(
            $message
        ));
    }
}