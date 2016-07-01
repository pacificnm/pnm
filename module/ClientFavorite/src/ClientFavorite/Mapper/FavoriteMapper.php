<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use ClientFavorite\Entity\FavoriteEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class FavoriteMapper implements FavoriteMapperInterface
{

    /**
     *
     * @var AdapterInterface
     */
    protected $readAdapter;

    /**
     *
     * @var AdapterInterface
     */
    protected $writeAdapter;

    /**
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     *
     * @var FavoriteEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param FavoriteEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, FavoriteEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Mapper\FavoriteMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_favorite');
        
        // clientStatus
        if (array_key_exists('authId', $filter) && ! empty($filter['authId'])) {
            $select->where(array(
                'client_favorite.auth_id =? ' => $filter['authId']
            ));
        }
        
        $select->join('client', 'client_favorite.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        $select->order('client.client_name');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Mapper\FavoriteMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_favorite');
        
        $select->join('client', 'client_favorite.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        $select->where(array(
            'client_favorite.client_favorite_id = ?' => $id
        ));
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result)->current();
        }
        
        return array();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Mapper\FavoriteMapperInterface::save()
     */
    public function save(FavoriteEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getClientFavoriteId()) {
            
            // ID present, it's an Update
            $action = new Update('client_favorite');
            
            $action->set($postData);
            
            $action->where(array(
                'client_favorite.client_favorite_id = ?' => $entity->getClientFavoriteId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('client_favorite');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setClientFavoriteId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Mapper\FavoriteMapperInterface::delete()
     */
    public function delete(FavoriteEntity $entity)
    {
        $action = new Delete('client_favorite');
        
        $action->where(array(
            'client_favorite.client_favorite_id = ?' => $entity->getClientFavoriteId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \ClientFavorite\Mapper\FavoriteMapperInterface::hasFavorite()
     */
    public function hasFavorite($clientId, $authId)
    {
        
        
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_favorite');
        
        $select->where(array(
            'client_favorite.auth_id =? ' => $authId
        ));
        
        $select->where(array(
            'client_favorite.client_id =? ' => $clientId
        ));
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
        
            $resultSet->buffer();
        
            $row = $resultSet->initialize($result)->current();
            
            return $row;
        }
        
        return false;
    }
}