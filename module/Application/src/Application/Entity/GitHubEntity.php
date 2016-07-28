<?php
namespace Application\Entity;

class GitHubEntity
{

    protected $url;

    protected $repositoryUrl;

    protected $labelsUrl;

    protected $commentsUrl;

    protected $eventsUrl;

    protected $htmlUrl;

    protected $id;

    protected $number;

    protected $title;

    protected $state;

    protected $locked;

    protected $createdAt;

    protected $updatedAt;

    protected $closedAt;

    protected $body;

    /**
     *
     * @return the $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     * @return the $repositoryUrl
     */
    public function getRepositoryUrl()
    {
        return $this->repositoryUrl;
    }

    /**
     *
     * @return the $labelsUrl
     */
    public function getLabelsUrl()
    {
        return $this->labelsUrl;
    }

    /**
     *
     * @return the $commentsUrl
     */
    public function getCommentsUrl()
    {
        return $this->commentsUrl;
    }

    /**
     *
     * @return the $eventsUrl
     */
    public function getEventsUrl()
    {
        return $this->eventsUrl;
    }

    /**
     *
     * @return the $htmlUrl
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     *
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @return the $state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     *
     * @return the $locked
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     *
     * @return the $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     *
     * @return the $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     *
     * @return the $closedAt
     */
    public function getClosedAt()
    {
        return $this->closedAt;
    }

    /**
     *
     * @return the $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     *
     * @param field_type $url            
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     *
     * @param field_type $repositoryUrl            
     */
    public function setRepositoryUrl($repositoryUrl)
    {
        $this->repositoryUrl = $repositoryUrl;
    }

    /**
     *
     * @param field_type $labelsUrl            
     */
    public function setLabelsUrl($labelsUrl)
    {
        $this->labelsUrl = $labelsUrl;
    }

    /**
     *
     * @param field_type $commentsUrl            
     */
    public function setCommentsUrl($commentsUrl)
    {
        $this->commentsUrl = $commentsUrl;
    }

    /**
     *
     * @param field_type $eventsUrl            
     */
    public function setEventsUrl($eventsUrl)
    {
        $this->eventsUrl = $eventsUrl;
    }

    /**
     *
     * @param field_type $htmlUrl            
     */
    public function setHtmlUrl($htmlUrl)
    {
        $this->htmlUrl = $htmlUrl;
    }

    /**
     *
     * @param field_type $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param field_type $number            
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     *
     * @param field_type $title            
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     *
     * @param field_type $state            
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     *
     * @param field_type $locked            
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    /**
     *
     * @param field_type $createdAt            
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     *
     * @param field_type $updatedAt            
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     *
     * @param field_type $closedAt            
     */
    public function setClosedAt($closedAt)
    {
        $this->closedAt = $closedAt;
    }

    /**
     *
     * @param field_type $body            
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}

