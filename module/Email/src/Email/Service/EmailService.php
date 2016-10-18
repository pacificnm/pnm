<?php
namespace Email\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Email\Entity\EmailEntity;
use Email\Mapper\EmailMapperInterface;
use Config\Service\ConfigServiceInterface;
use Zend\Crypt\BlockCipher;

class EmailService implements EmailServiceInterface
{

    /**
     *
     * @var EmailMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var ConfigServiceInterface
     */
    protected $configService;

    /**
     * 
     * @var $config
     */
    protected $config;
    
    /**
     * 
     * @param EmailMapperInterface $mapper
     * @param ConfigServiceInterface $configService
     * @param array $config
     */
    public function __construct(EmailMapperInterface $mapper, ConfigServiceInterface $configService, array $config)
    {
        $this->mapper = $mapper;
        
        $this->configService = $configService;
        
        $this->config = $config;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Email\Service\EmailServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Email\Service\EmailServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Email\Service\EmailServiceInterface::save()
     */
    public function save(EmailEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Email\Service\EmailServiceInterface::delete()
     */
    public function delete(EmailEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Email\Service\EmailServiceInterface::send()
     */
    public function send(EmailEntity $entity)
    {
        // load default config
        $configEntity = $this->configService->get(1);
        
        $blockCipher = BlockCipher::factory('mcrypt', array(
            'algo' => 'aes'
        ));
        
        $blockCipher->setKey($this->config['encryption-key']);
        
        
        $text = new MimePart(strip_tags($entity->getEmailBody()));
        $text->type = "text/plain";
        
        $html = new MimePart($entity->getEmailBody());
        $html->type = "text/html";
        
        $body = new MimeMessage();
        $body->setParts(array($text, $html));
        
        $message = new Message();
        
        $message->addTo($entity->getEmailToAddress(), $entity->getEmailToName())
            ->addFrom($entity->getEmailFromAddress(), $entity->getEmailFromName())
            ->setSubject($entity->getEmailSubject())
            ->setBody($body);
            
        $transport = new SmtpTransport();
        
        $options = new SmtpOptions(array(
            'name'              => $configEntity->getConfigSmtpHost(),
            'host'              => $configEntity->getConfigSmtpHost(),
            'port'              => $configEntity->getConfigSmtpPort(), // Notice port change for TLS is 587
            'connection_class'  => 'plain',
            'connection_config' => array(
                'username' => $configEntity->getConfigSmtpEmail(),
                'password' => $blockCipher->decrypt($configEntity->getConfigSmtpPassword()),
                'ssl'      => 'tls',
            ),
        ));
        
        $transport->setOptions($options);
        
        try {
            $transport->send($message);
            
            $emailLog = "Email Sent " . date("m/d/Y h:i a", time());
        } catch (\Exception $e) {
            $emailLog = $e->getMessage();
        }
        
        $entity->setEmailLog($emailLog);
        
        $this->save($entity);
    }
}