<?php
namespace CallLogEmail\Service;

use CallLogEmail\Entity\CallLogEmailEntity;
use CallLogEmail\Mapper\MysqlMapperInterface;
use Email\Service\EmailServiceInterface;
use CallLog\Entity\LogEntity;
use Email\Entity\EmailEntity;
use CallLogNote\Entity\NoteEntity;
use Config\Service\ConfigServiceInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;


class CallLogEmailService implements CallLogEmailServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var EmailServiceInterface
     */
    protected $emailService;

    /**
     *
     * @var ConfigServiceInterface
     */
    protected $configService;

    /**
     *
     * @var RendererInterface
     */
    protected $renderer;
    
    
    /**
     * 
     * @param MysqlMapperInterface $mapper
     * @param EmailServiceInterface $emailService
     * @param ConfigServiceInterface $configService
     * @param RendererInterface $renderer
     */
    public function __construct(MysqlMapperInterface $mapper, EmailServiceInterface $emailService, ConfigServiceInterface $configService, RendererInterface $renderer)
    {
        $this->mapper = $mapper;
        
        $this->emailService = $emailService;
        
        $this->configService = $configService;
        
        $this->renderer = $renderer;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Service\CallLogEmailServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Service\CallLogEmailServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Service\CallLogEmailServiceInterface::save()
     */
    public function save(CallLogEmailEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Service\CallLogEmailServiceInterface::delete()
     */
    public function delete(CallLogEmailEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Service\CallLogEmailServiceInterface::mapEmail()
     */
    public function mapEmail($callLogId, $emailId)
    {
        $entity = new CallLogEmailEntity();
        
        $entity->setCallLogId($callLogId);
        
        $entity->setEmailId($emailId);
        
        $entity->setCallLogEmailId(0);
        
        $this->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLogEmail\Service\CallLogEmailServiceInterface::sendCallLogEmail($entity)
     */
    public function sendCallLogEmail(LogEntity $logEntity)
    {
        return $this->createEmail($logEntity, null, 'call-log-create', "New Call Log from {$logEntity->getClientEntity()->getClientName()}");
    }

    /**
     *
     * @param LogEntity $logEntity            
     * @param NoteEntity $noteEntity            
     * @param string $emailTemplate            
     * @param string $emailSubject            
     * @return \Email\Entity\EmailEntity
     */
    protected function createEmail($logEntity, $noteEntity, $emailTemplate, $emailSubject)
    {
        // get config entity
        $configEntity = $this->configService->get(1);
        
        // create email
        $emailEntity = new EmailEntity();
        
        $emailEntity->setEmailBody($this->getEmailBody($logEntity, $noteEntity, $emailTemplate));
        
        $emailEntity->setEmailDateCreated(time());
        
        $emailEntity->setEmailDateSent(0);
        
        $emailEntity->setEmailFromAddress($configEntity->getConfigSmtpEmail());
        
        $emailEntity->setEmailFromName($configEntity->getConfigSmtpDisplay());
        
        $emailEntity->setEmailId(0);
        
        $emailEntity->setEmailSubject($emailSubject);
        
        $emailEntity->setEmailToAddress($logEntity->getEmployeeEntity()->getEmployeeEmail());
        
        $emailEntity->setEmailToName($logEntity->getEmployeeEntity()->getEmployeeName());
        
        $emailEntity = $this->emailService->save($emailEntity);
        
        // map email
        $this->mapEmail($logEntity->getCallLogId(), $emailEntity->getEmailId());
        
        // send email
        $this->emailService->send($emailEntity);
        
        return $emailEntity;
    }

    /**
     *
     * @param LogEntity $logEntity            
     * @param NoteEntity $noteEntity            
     * @param unknown $template            
     */
    protected function getEmailBody($logEntity, $noteEntity, $template)
    {
        // create body
        $viewContent = new ViewModel(array(
            'clientEntity' => $logEntity->getClientEntity(),
            'logEntity' => $logEntity,
            'noteEntity' => $noteEntity
        ));
        
        $viewContent->setTemplate($template);
        
        return $this->renderer->render($viewContent);
    }
}