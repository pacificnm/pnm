<?php
namespace HostAttributeMap\Service;

use HostAttributeMap\Entity\MapEntity;

interface MapServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return MapEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return MapEntity
     */
    public function get($id);

    /**
     *
     * @param number $hostId            
     * @return MapEntity
     */
    public function getHostAttributes($hostId);

    /**
     *
     * @param number $hostId            
     * @param number $hostAttributeId            
     * @param string $hostAttributeMapValue            
     *
     * @return MapEntity
     */
    public function saveSelect($hostId, $hostAttributeId, $hostAttributeMapValue);

    /**
     *
     * @param number $hostId            
     * @param number $hostAttributeId            
     * @param string $hostAttributeMapValue            
     *
     * @return MapEntity
     */
    public function saveText($hostId, $hostAttributeId, $hostAttributeMapValue);

    /**
     * 
     * @param number $hostId
     * @param unknown $postData
     */
    public function saveWorkstation($hostId, $postData);
    
    /**
     * 
     * @param number $hostId
     * @param unknown $postData
     */
    public function saveServer($hostId, $postData);
    
    /**
     *
     * @param number $hostId
     * @param unknown $postData
     */
    public function saveLaptop($hostId, $postData);
    
    /**
     * 
     * @param number $hostId
     * @param unknown $postData
     */
    public function saveTablet($hostId, $postData);
    
    /**
     * 
     * @param unknown $hostId
     * @param unknown $postData
     */
    public function savePrinter($hostId, $postData);
    
    /**
     * 
     * @param unknown $hostId
     * @param unknown $postData
     */
    public function saveCopier($hostId, $postData);
    
    /**
     * 
     * @param unknown $hostId
     * @param unknown $postdata
     */
    public function saveScanner($hostId, $postData);
    
    /**
     * 
     * @param unknown $hostId
     * @param unknown $postData
     */
    public function saveRouter($hostId, $postData);
    
    /**
     * 
     * @param unknown $hostId
     * @param unknown $postData
     */
    public function saveSwitch($hostId, $postData);
    
    
    /**
     *
     * @param MapEntity $entity            
     * @return MapEntity
     */
    public function save(MapEntity $entity);

    /**
     *
     * @param MapEntity $entity            
     * @return boolean
     */
    public function delete(MapEntity $entity);
}