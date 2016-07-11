<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Estimate\Service;

use Estimate\Entity\EstimateEntity;
use Estimate\Mapper\EstimateMapperInterface;

class EstimateService implements EstimateServiceInterface
{

    /**
     *
     * @var EstimateMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param EstimateMapperInterface $mapper            
     */
    public function __construct(EstimateMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Estimate\Service\EstimateServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Estimate\Service\EstimateServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Estimate\Service\EstimateServiceInterface::save()
     */
    public function save(EstimateEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Estimate\Service\EstimateServiceInterface::delete()
     */
    public function delete(EstimateEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}