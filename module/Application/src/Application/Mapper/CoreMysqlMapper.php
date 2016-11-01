<?php
namespace Application\Mapper;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;

class CoreMysqlMapper
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
     * @var Entity
     */
    protected $prototype;
    
    /**
     *
     * @var Sql
     */
    protected $readSql;
    
    /**
     *
     * @var Sql
     */
    protected $writeSql;
    
    /**
     *
     * @var Delete
     */
    protected $delete;
    
    /**
     *
     * @var Insert
     */
    protected $insert;
    
    /**
     *
     * @var Update
     */
    protected $update;
    
    /**
     *
     * @var Select
     */
    protected $select;
    
    /**
     *
     * @var boolean
     */
    protected $debug = false;
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter)
    {
        $this->readAdapter = $readAdapter;
    
        $this->writeAdapter = $writeAdapter;
    
        $this->readSql = new Sql($this->readAdapter);
    
        $this->writeSql = new Sql($this->writeAdapter);
    
        $this->delete = new Delete();
    
        $this->insert = new Insert();
    
        $this->update = new Update();
    
    }
    
    /**
     *
     * @return \Zend\Paginator\Paginator
     */
    protected function getPaginator()
    {
        if($this->debug) {
            echo $this->readSql->getSqlstringForSqlObject($this->select); die;
        }
       
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
    
        $paginatorAdapter = new DbSelect($this->select, $this->readAdapter, $resultSetPrototype);
    
        $paginator = new Paginator($paginatorAdapter);
    
        return $paginator;
    }
    
    /**
     *
     * @return \Zend\Db\ResultSet\ResultSet
     */
    protected function getRows()
    {
        if($this->debug) {
            echo $this->readSql->getSqlstringForSqlObject($this->select); die;
        }
    
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
    
        $result = $stmt->execute();
    
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
    
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
    
            $resultSet->buffer();
    
            return $resultSet->initialize($result);
        }
    
        return array();
    }
    
    /**
     *
     * @return ArrayObject|NULL
     */
    protected function getRow()
    {
        if($this->debug) {
            echo $this->readSql->getSqlstringForSqlObject($this->select); die;
        }
    
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
    
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
     * @return mixed|NULL|NULL
     */
    protected function createRow()
    {
        if($this->debug) {
            echo $this->writeSql->getSqlstringForSqlObject($this->insert); die;
        }
    
        $stmt = $this->writeSql->prepareStatementForSqlObject($this->insert);
    
        $result = $stmt->execute();
    
        $newId = $result->getGeneratedValue();
    
        if ($result instanceof ResultInterface) {
    
            if ($newId) {
                return $newId;
            }
            return null;
        }
    
        throw new \Exception('Database error');
    }
    
    /**
     *
     * @throws \Exception
     * @return boolean
     */
    protected function updateRow()
    {
        $stmt = $this->writeSql->prepareStatementForSqlObject($this->update);
    
        $result = $stmt->execute();
    
        if ($result instanceof ResultInterface) {
            return true;
        }
    
        throw new \Exception('Database error');
    }
    
    
    /**
     *
     * @return boolean
     */
    protected function deleteRow()
    {
        if($this->debug) {
            echo $this->writeSql->getSqlstringForSqlObject($this->delete); die;
        }
    
        $stmt = $this->writeSql->prepareStatementForSqlObject($this->delete);
    
        $result = $stmt->execute();
    
        return (bool) $result->getAffectedRows();
    }
    
}