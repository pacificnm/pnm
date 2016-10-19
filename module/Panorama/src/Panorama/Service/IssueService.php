<?php
namespace Panorama\Service;

use Panorama\Entity\IssueEntity;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Config\Service\ConfigServiceInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class IssueService extends PanoramaService implements IssueServiceInterface
{

    /**
     *
     * @var IssueEntity
     */
    protected $prototype;

    /**
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     *
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param ConfigServiceInterface $configService            
     * @param unknown $encryptionKey            
     * @param IssueEntity $prototype            
     * @param HydratorInterface $hydrator            
     * @param Memcached $memcached            
     */
    public function __construct(ConfigServiceInterface $configService, $encryptionKey, IssueEntity $prototype, HydratorInterface $hydrator, Memcached $memcached)
    {
        $this->prototype = $prototype;
        
        $this->hydrator = $hydrator;
        
        $this->memcached = $memcached;
        
        parent::__construct($configService, $encryptionKey);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::getIssue()
     */
    public function getIssue($id)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/issues/' . $id);
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::getAllIssues()
     */
    public function getAllIssues($cid)
    {
        $key = 'panorama-getAllIssues-' . $cid;
        
        $data = $this->memcached->getItem($key);
        
        if (! $data) {
            $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/issues');
            
            $this->request->setMethod('GET');
            
            $response = $this->send();
            
            // if we have a success
            if ($response->isSuccess()) {
                $data = json_decode($response->getBody(), true);
                
                $this->memcached->setItem($key, $data);
            } else {
                $this->getError($response);
            }
        }
        
        $result = $this->hydratingResultSet($data);
        
        return $result;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::getDeviceIssues()
     */
    public function getDeviceIssues($id)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/devices/' . $id . '/issues');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::getLatestIssues()
     */
    public function getLatestIssues($cid, $hours = 24)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/issues/vulnerability');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::getVulnerabilityIssues()
     */
    public function getVulnerabilityIssues($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/issues/vulnerability');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::getAvailabilityIssues()
     */
    public function getAvailabilityIssues($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/issues/availability');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::getComplianceIssues()
     */
    public function getComplianceIssues($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/issues/compliance');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::snoozeIssue()
     */
    public function snoozeIssue($id, $period)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/issues/' . $id . '/snooze/' . $period);
        
        $this->request->setMethod('PUT');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\IssueServiceInterface::patchIssue()
     */
    public function patchIssue($id)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/devices/' . $id . '/remote-control/patch-now');
        
        $this->request->setMethod('PUT');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydrator->hydrate($data, clone $this->prototype);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }
}