<?php
namespace Panorama\Service;

use Zend\Http\Client;
use Zend\Http\Response;
use Zend\Crypt\BlockCipher;
use Config\Service\ConfigServiceInterface;
use Zend\Http\Request;

abstract class PanoramaService
{

    /**
     *
     * @var Client
     */
    protected $client;

    /**
     *
     * @var Request
     */
    protected $request;

    /**
     *
     * @var string
     */
    protected $apiKey;

    /**
     *
     * @var ConfigServiceInterface
     */
    protected $configService;

    protected $maxredirects = 0;

    protected $timeout = 10;

    protected $count;
    
    /**
     *
     * @param ConfigServiceInterface $configService            
     * @param string $encryptionKey            
     */
    public function __construct(ConfigServiceInterface $configService, $encryptionKey)
    {
        $this->configService = $configService;
        
        $configEntity = $configService->get(1);
        
        $blockCipher = BlockCipher::factory('mcrypt', array(
            'algo' => 'aes'
        ));
        
        $blockCipher->setKey($encryptionKey);
        
        $this->apiKey = $blockCipher->decrypt($configEntity->getConfigPanoramaKey());
        
        $this->request = new Request();
        
        $this->request->getHeaders()->addHeaders(array(
            'Authorization' => 'OAuth ' . $this->apiKey
        ));
        
        $this->client = new Client();
   
    }

    public function send()
    {
        
        
        $response = $this->client->dispatch($this->request);
        
        return $response;
    }

    public function getError(Response $response)
    {
        // throw error for the moment with status prase
        throw new \Exception($response->getReasonPhrase());
    }
    
    public function hydratingResultSet($data)
    {
        $array = array();
        
        foreach($data as $key => $val) {
            $object = $this->hydrator->hydrate($val, clone $this->prototype);
            
            $array[] = $object;
            
        }
        return $array;
    }
    
    public function count()
    {
        
    }
}

?>