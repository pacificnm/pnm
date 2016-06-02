<?php
namespace Message\Entity;

class MessageEntity
{

    /**
     *
     * @var number
     */
    protected $messageId;

    /**
     *
     * @var number
     */
    protected $messageDate;

    /**
     *
     * @var string
     */
    protected $messageSubject;

    /**
     *
     * @var string
     */
    protected $messageBody;

    /**
     *
     * @var string
     */
    protected $messageToEmail;

    /**
     *
     * @var string
     */
    protected $messageToName;

    /**
     *
     * @return the $messageId
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     *
     * @return the $messageDate
     */
    public function getMessageDate()
    {
        return $this->messageDate;
    }

    /**
     *
     * @return the $messageSubject
     */
    public function getMessageSubject()
    {
        return $this->messageSubject;
    }

    /**
     *
     * @return the $messageBody
     */
    public function getMessageBody()
    {
        return $this->messageBody;
    }

    /**
     *
     * @return the $messageToEmail
     */
    public function getMessageToEmail()
    {
        return $this->messageToEmail;
    }

    /**
     *
     * @return the $messageToName
     */
    public function getMessageToName()
    {
        return $this->messageToName;
    }

    /**
     *
     * @param number $messageId            
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    }

    /**
     *
     * @param number $messageDate            
     */
    public function setMessageDate($messageDate)
    {
        $this->messageDate = $messageDate;
    }

    /**
     *
     * @param string $messageSubject            
     */
    public function setMessageSubject($messageSubject)
    {
        $this->messageSubject = $messageSubject;
    }

    /**
     *
     * @param string $messageBody            
     */
    public function setMessageBody($messageBody)
    {
        $this->messageBody = $messageBody;
    }

    /**
     *
     * @param string $messageToEmail            
     */
    public function setMessageToEmail($messageToEmail)
    {
        $this->messageToEmail = $messageToEmail;
    }

    /**
     *
     * @param string $messageToName            
     */
    public function setMessageToName($messageToName)
    {
        $this->messageToName = $messageToName;
    }
}