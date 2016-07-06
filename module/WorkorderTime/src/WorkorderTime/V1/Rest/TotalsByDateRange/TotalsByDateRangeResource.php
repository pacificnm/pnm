<?php
namespace WorkorderTime\V1\Rest\TotalsByDateRange;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use WorkorderTime\Service\TimeServiceInterface;

class TotalsByDateRangeResource extends AbstractResourceListener
{
    /**
     * 
     * @var TimeServiceInterface
     */
    protected $timeService;
    
    /**
     * 
     * @param TimeServiceInterface $timeService
     */
    public function __construct(TimeServiceInterface $timeService)
    {
        $this->timeService = $timeService;
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
        $start = $params['start'];
        
        $end = $params['end'];
        
        $start = mktime(0,0,0,date("m"), 1, date("Y"));
        
        $end = mktime(23,59,59, date("m"), date("t"), date("Y"));
        
        $timeEntitys = $this->timeService->getTotalsForMonth($start, $end);
        
        $data = array();
        
        foreach($timeEntitys as $timeEntity) {
           $data[] = array(
               'total' => $timeEntity->workorder_labor_total,
               'date' => date("d", $timeEntity->workorder_time_in)
           );
        }
        
        return $data;
        
        return new ApiProblem(405, 'The GET method has not been defined for collections');
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
