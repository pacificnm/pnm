<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Workorder\V1\Rest\Schedule;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Workorder\Service\WorkorderServiceInterface;

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class ScheduleResource extends AbstractResourceListener
{
    /**
     * 
     * @var WorkorderServiceInterface
     */
    protected $workorderService;
    
    /**
     * 
     * @param WorkorderServiceInterface $workorderService
     */
    public function __construct(WorkorderServiceInterface $workorderService)
    {
        $this->workorderService = $workorderService;
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
       
        $filter = array();
        
        $filter['employee'] = $params['employee'];
        $filter['client'] = $params['client'];
        $filter['start'] = $params['start'];
        $filter['end'] = $params['end'];
        
        $data = array();
        
        $workorderEntitys = $this->workorderService->getWorkorderSchedule($filter);
        
        foreach($workorderEntitys as $workorderEntity) {
            $title = $workorderEntity->getClientEntity()->getClientName() . ' - #' . $workorderEntity->getWorkorderId() . ' ' .$workorderEntity->getWorkorderTitle();
            $data[] = array(
                'id' => $workorderEntity->getWorkorderId(),
                'title' => $title,
                'start' => date("c", $workorderEntity->getWorkorderDateScheduled()),
                'end' => date("c", $workorderEntity->getWorkorderDateEnd()),
                'url' => '/client/'.$workorderEntity->getClientId().'/work-order/'.$workorderEntity->getWorkorderId().'/view'
            );
        }
        
        return $data;
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
