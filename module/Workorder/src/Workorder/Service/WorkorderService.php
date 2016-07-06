<?php
namespace Workorder\Service;

use Workorder\Entity\WorkorderEntity;
use Workorder\Mapper\WorkorderMapperInterface;

class WorkorderService implements WorkorderServiceInterface
{

    /**
     *
     * @var WorkorderMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param WorkorderMapperInterface $mapper            
     */
    public function __construct(WorkorderMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::save()
     */
    public function save(WorkorderEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::delete()
     */
    public function delete(WorkorderEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getByDateRange()
     */
    public function getByDateRange($start, $end, $status)
    {
        return $this->mapper->getByDateRange($start, $end, $status);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getClientTotalCount()
     */
    public function getClientTotalCount($clientId, $status)
    {
        return $this->mapper->getClientTotalCount($clientId, $status);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getClientTotalLabor()
     */
    public function getClientTotalLabor($clientId)
    {
        return $this->mapper->getClientTotalLabor($clientId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getClientTotalPart()
     */
    public function getClientTotalPart($clientId)
    {
        return $this->mapper->getClientTotalPart($clientId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getClientUnInvoiced()
     */
    public function getClientUnInvoiced($clientId)
    {
        return $this->mapper->getClientUnInvoiced($clientId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getInvoiceWorkorders()
     */
    public function getInvoiceWorkorders($invoiceId)
    {
        return $this->mapper->getInvoiceWorkorders($invoiceId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getClientActiveWorkOrders()
     */
    public function getClientActiveWorkOrders($clientId)
    {
        $filter = array(
            'clientId' => $clientId,
            'workorderStatus' => 'Active'
        );
        
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getWorkorderSchedule()
     */
    public function getWorkorderSchedule(array $filter)
    {
        return $this->mapper->getWorkorderSchedule($filter);
    }
}