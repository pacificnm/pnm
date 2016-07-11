<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Estimate\Mapper;

use Estimate\Entity\EstimateEntity;

interface EstimateMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return EstimateEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return EstimateEntity
     */
    public function get($id);

    /**
     *
     * @param EstimateEntity $entity            
     * @return EstimateEntity
     */
    public function save(EstimateEntity $entity);

    /**
     *
     * @param EstimateEntity $entity            
     * @return boolean
     */
    public function delete(EstimateEntity $entity);
}
