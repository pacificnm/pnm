<?php
namespace TicketEmail\Service;

use TicketEmail\Entity\TicketEmailEntity;
use TicketEmail\Mapper\TicketEmailMapperInterface;
use Ticket\Entity\TicketEntity;
use Email\Entity\EmailEntity;
use Email\Service\EmailServiceInterface;
use Config\Service\ConfigServiceInterface;
use Client\Service\ClientServiceInterface;
use User\Service\UserServiceInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Model\ViewModel;
use TicketNote\Entity\NoteEntity;

class TicketEmailService implements TicketEmailServiceInterface
{

    /**
     *
     * @var unknown
     */
    protected $mapper;

    /**
     *
     * @var EmailServiceInterface
     */
    protected $emailService;

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var UserServiceInterface
     */
    protected $userService;

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
     * @param TicketEmailMapperInterface $mapper            
     * @param EmailServiceInterface $emailService            
     * @param ClientServiceInterface $clientService            
     * @param UserServiceInterface $userService            
     * @param ConfigServiceInterface $configService            
     * @param RendererInterface $renderer            
     */
    public function __construct(TicketEmailMapperInterface $mapper, EmailServiceInterface $emailService, ClientServiceInterface $clientService, UserServiceInterface $userService, ConfigServiceInterface $configService, RendererInterface $renderer)
    {
        $this->mapper = $mapper;
        
        $this->emailService = $emailService;
        
        $this->configService = $configService;
        
        $this->clientService = $clientService;
        
        $this->userService = $userService;
        
        $this->renderer = $renderer;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketEmail\Service\TicketEmailServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketEmail\Service\TicketEmailServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketEmail\Service\TicketEmailServiceInterface::save()
     */
    public function save(TicketEmailEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketEmail\Service\TicketEmailServiceInterface::delete()
     */
    public function delete(TicketEmailEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketEmail\Service\TicketEmailServiceInterface::sendTicketCreate()
     */
    public function sendTicketCreate(TicketEntity $ticketEntity)
    {
        return $this->createEmail($ticketEntity, null, 'ticket-create-employee', "New Ticket #{$ticketEntity->getTicketId()} " . $ticketEntity->getTicketTitle());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketEmail\Service\TicketEmailServiceInterface::sendTicketClose()
     */
    public function sendTicketClose(TicketEntity $ticketEntity)
    {
        return $this->createEmail($ticketEntity, null, 'ticket-close', "Ticket #{$ticketEntity->getTicketId()} " . $ticketEntity->getTicketTitle() . " Closed");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketEmail\Service\TicketEmailServiceInterface::sendTicketNote()
     */
    public function sendTicketNote(TicketEntity $ticketEntity, NoteEntity $noteEntity)
    {
        return $this->createEmail($ticketEntity, $noteEntity, 'ticket-note-create', "New note added to Ticket #{$ticketEntity->getTicketId()}");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketEmail\Service\TicketEmailServiceInterface::sendTicketNoteUpdate()
     */
    public function sendTicketNoteUpdate(TicketEntity $ticketEntity, NoteEntity $noteEntity)
    {
        return $this->createEmail($ticketEntity, $noteEntity, 'ticket-note-update', "Note was updated on Ticket #{$ticketEntity->getTicketId()}");
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketEmail\Service\TicketEmailServiceInterface::mapEmail()
     */
    public function mapEmail($emailId, $ticketId)
    {
        $ticketEmailEntity = new TicketEmailEntity();
        
        $ticketEmailEntity->setEmailId($emailId);
        
        $ticketEmailEntity->setTicketId($ticketId);
        
        $ticketEmailEntity = $this->save($ticketEmailEntity);
    }

    /**
     *
     * @param TicketEntity $ticketEntity            
     * @param string $template            
     * @return string
     */
    protected function getEmailBody($ticketEntity, $noteEntity, $template)
    {
        $clientEntity = $this->clientService->get($ticketEntity->getClientId());
        
        $userEntity = $this->userService->get($ticketEntity->getUserId());
        
        // create body
        $viewContent = new ViewModel(array(
            'clientEntity' => $clientEntity,
            'userEntity' => $userEntity,
            'ticketEntity' => $ticketEntity,
            'noteEntity' => $noteEntity
        ));
        
        $viewContent->setTemplate($template);
        
        return $this->renderer->render($viewContent);
    }

    /**
     *
     * @param TicketEntity $ticketEntity            
     * @param string $emailTemplate            
     * @param string $emailSubject            
     * @return \Email\Entity\EmailEntity
     */
    protected function createEmail(TicketEntity $ticketEntity, $noteEntity, $emailTemplate, $emailSubject)
    {
        // get config entity
        $configEntity = $this->configService->get(1);
        
        // create email
        $emailEntity = new EmailEntity();
        
        $emailEntity->setEmailBody($this->getEmailBody($ticketEntity, $noteEntity, $emailTemplate));
        
        $emailEntity->setEmailDateCreated(time());
        
        $emailEntity->setEmailDateSent(0);
        
        $emailEntity->setEmailFromAddress($configEntity->getConfigSmtpEmail());
        
        $emailEntity->setEmailFromName($configEntity->getConfigSmtpDisplay());
        
        $emailEntity->setEmailId(0);
        
        $emailEntity->setEmailSubject($emailSubject);
        
        $emailEntity->setEmailToAddress($configEntity->getConfigSmtpEmail());
        
        $emailEntity->setEmailToName($configEntity->getConfigSmtpEmail());
        
        $emailEntity = $this->emailService->save($emailEntity);
        
        // map email
        $this->mapEmail($emailEntity->getEmailId(), $ticketEntity->getTicketId());
        
        // send email
        $this->emailService->send($emailEntity);
        
        return $emailEntity;
    }
}