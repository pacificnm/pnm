<?php
namespace Panorama\Entity;

class MspEntity
{

    /**
     *
     * @var string
     */
    protected $cid;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $alias;

    /**
     *
     * @var number
     */
    protected $agents;

    /**
     *
     * @var number
     */
    protected $blindspotted;

    /**
     *
     * @var number
     */
    protected $vulnerabilities;

    /**
     *
     * @var number
     */
    protected $availability;

    /**
     *
     * @var number
     */
    protected $compliance;

    /**
     *
     * @var number
     */
    protected $serverIssues;

    /**
     *
     * @var number
     */
    protected $unreachable;

    /**
     *
     * @var number
     */
    protected $patchIssues;

    /**
     *
     * @var number
     */
    protected $workstations;

    /**
     *
     * @var number
     */
    protected $servers;

    /**
     *
     * @var number
     */
    protected $internetServiceIssues;

    /**
     *
     * @return the $cid
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     *
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return the $alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     *
     * @return the $agents
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     *
     * @return the $blindspotted
     */
    public function getBlindspotted()
    {
        return $this->blindspotted;
    }

    /**
     *
     * @return the $vulnerabilities
     */
    public function getVulnerabilities()
    {
        return $this->vulnerabilities;
    }

    /**
     *
     * @return the $availability
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     *
     * @return the $compliance
     */
    public function getCompliance()
    {
        return $this->compliance;
    }

    /**
     *
     * @return the $serverIssues
     */
    public function getServerIssues()
    {
        return $this->serverIssues;
    }

    /**
     *
     * @return the $unreachable
     */
    public function getUnreachable()
    {
        return $this->unreachable;
    }

    /**
     *
     * @return the $patchIssues
     */
    public function getPatchIssues()
    {
        return $this->patchIssues;
    }

    /**
     *
     * @return the $workstations
     */
    public function getWorkstations()
    {
        return $this->workstations;
    }

    /**
     *
     * @return the $servers
     */
    public function getServers()
    {
        return $this->servers;
    }

    /**
     *
     * @return the $internetServiceIssues
     */
    public function getInternetServiceIssues()
    {
        return $this->internetServiceIssues;
    }

    /**
     *
     * @param string $cid            
     */
    public function setCid($cid)
    {
        $this->cid = $cid;
    }

    /**
     *
     * @param string $name            
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $alias            
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     *
     * @param number $agents            
     */
    public function setAgents($agents)
    {
        $this->agents = $agents;
    }

    /**
     *
     * @param number $blindspotted            
     */
    public function setBlindspotted($blindspotted)
    {
        $this->blindspotted = $blindspotted;
    }

    /**
     *
     * @param number $vulnerabilities            
     */
    public function setVulnerabilities($vulnerabilities)
    {
        $this->vulnerabilities = $vulnerabilities;
    }

    /**
     *
     * @param number $availability            
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    /**
     *
     * @param number $compliance            
     */
    public function setCompliance($compliance)
    {
        $this->compliance = $compliance;
    }

    /**
     *
     * @param number $serverIssues            
     */
    public function setServerIssues($serverIssues)
    {
        $this->serverIssues = $serverIssues;
    }

    /**
     *
     * @param number $unreachable            
     */
    public function setUnreachable($unreachable)
    {
        $this->unreachable = $unreachable;
    }

    /**
     *
     * @param number $patchIssues            
     */
    public function setPatchIssues($patchIssues)
    {
        $this->patchIssues = $patchIssues;
    }

    /**
     *
     * @param number $workstations            
     */
    public function setWorkstations($workstations)
    {
        $this->workstations = $workstations;
    }

    /**
     *
     * @param number $servers            
     */
    public function setServers($servers)
    {
        $this->servers = $servers;
    }

    /**
     *
     * @param number $internetServiceIssues            
     */
    public function setInternetServiceIssues($internetServiceIssues)
    {
        $this->internetServiceIssues = $internetServiceIssues;
    }
}