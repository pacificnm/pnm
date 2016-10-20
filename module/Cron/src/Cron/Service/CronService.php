<?php
namespace Cron\Service;

use Cron\Entity\CronEntity;
use Cron\Mapper\MysqlMapperInterface;

class CronService implements CronServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Cron\Service\CronServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Cron\Service\CronServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Cron\Service\CronServiceInterface::save()
     */
    public function save(CronEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Cron\Service\CronServiceInterface::delete()
     */
    public function delete(CronEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}