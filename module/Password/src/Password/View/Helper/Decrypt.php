<?php
namespace Password\View\Helper;
use Zend\Crypt\BlockCipher;
use Zend\View\Helper\AbstractHelper;

class Decrypt extends AbstractHelper
{
    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    /**
     * 
     * @param string $string
     * @return string|boolean
     */
    public function __invoke($string)
    {
        // make sure we have an encryption key
        if (! array_key_exists('encryption-key', $this->config) || empty($this->config['encryption-key'])) {
            throw new \Exception('missing encryption-key. You need to add the config key in the local.php config and provide a random string for default encryption');
        }
        
        
        $blockCipher = BlockCipher::factory('mcrypt', array(
            'algo' => 'aes'
        ));
        
        $blockCipher->setKey($this->config['encryption-key']);
        
        $string =  $blockCipher->decrypt($string);
        
        return $string;
    }
}