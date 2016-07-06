<?php
namespace WorkorderTime\V1\Rest\TotalsByDateRange;

class TotalsByDateRangeResourceFactory
{
    public function __invoke($services)
    {
        $timeService = $services->get('WorkorderTime\Service\TimeServiceInterface');
        
        return new TotalsByDateRangeResource($timeService);
    }
}
