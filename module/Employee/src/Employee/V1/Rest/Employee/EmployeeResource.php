<?php
namespace Employee\V1\Rest\Employee;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Employee\Service\EmployeeServiceInterface;
use Zend\Crypt\BlockCipher;

class EmployeeResource extends AbstractResourceListener
{
    /**
     * 
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     * 
     * @var BlockCipher
     */
    protected $blockCipher;
    
    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     */
    public function __construct(EmployeeServiceInterface $employeeService, array $config)
    {
        $this->employeeService = $employeeService;
        
        $this->config = $config;
        
        $this->blockCipher = BlockCipher::factory('mcrypt', array(
            'algo' => 'aes'
        ));
        
        $this->blockCipher->setKey($this->config['encryption-key']);
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
        $data = array();
        
        $employeeEntity = $this->employeeService->get($id);
        
        $employeeSsn = "";
        
        if($employeeEntity->getEmployeeSsn()) {
            $employeeSsn = $this->blockCipher->decrypt($employeeEntity->getEmployeeSsn());
        }
        
        $data = array(
            'employeeId' => $employeeEntity->getEmployeeId(),
            'employeeName' => $employeeEntity->getEmployeeName(),
            'employeeTitle' => $employeeEntity->getEmployeeTitle(),
            'employeeEmail' => $employeeEntity->getEmployeeEmail(),
            'employeePhone' => $employeeEntity->getEmployeePhone(),
            'employeePhoneMobile' => $employeeEntity->getEmployeePhoneMobile(),
            'employeeStreet' => $employeeEntity->getEmployeeStreet(),
            'employeeStreetCont' => $employeeEntity->getEmployeeStreetCont(),
            'employeeCity' => $employeeEntity->getEmployeeCity(),
            'employeeState' => $employeeEntity->getEmployeeState(),
            'employeePostal' => $employeeEntity->getEmployeePostal(),
            'employeeIm' => $employeeEntity->getEmployeeIm(),
            'employeeImage' => $employeeEntity->getEmployeeImage(),
            'employeeStatus' => $employeeEntity->getEmployeeStatus(),
            'employeBirthday' => $employeeEntity->getEmployeBirthday(),
            'employeeMaritalStatus' => $employeeEntity->getEmployeeMaritalStatus(),
            'employeeWage' => $employeeEntity->getEmployeeWage(),
            'employeeTaxAllowance' => $employeeEntity->getEmployeeTaxAllowance(),
            'employeeSsn' => $employeeSsn
        );
        
        return $data;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $filter = array();
        
        $data = array();
        
        $employeeEntitys =  $this->employeeService->getAll($filter);
        
        foreach($employeeEntitys as $employeeEntity) {
            
            $employeeSsn = "";
            
            if($employeeEntity->getEmployeeSsn()) {
                $employeeSsn = $this->blockCipher->decrypt($employeeEntity->getEmployeeSsn());
            }
            
            $data[] = array(
                'employeeId' => $employeeEntity->getEmployeeId(),
                'employeeName' => $employeeEntity->getEmployeeName(),
                'employeeTitle' => $employeeEntity->getEmployeeTitle(),
                'employeeEmail' => $employeeEntity->getEmployeeEmail(),
                'employeePhone' => $employeeEntity->getEmployeePhone(),
                'employeePhoneMobile' => $employeeEntity->getEmployeePhoneMobile(),
                'employeeStreet' => $employeeEntity->getEmployeeStreet(),
                'employeeStreetCont' => $employeeEntity->getEmployeeStreetCont(),
                'employeeCity' => $employeeEntity->getEmployeeCity(),
                'employeeState' => $employeeEntity->getEmployeeState(),
                'employeePostal' => $employeeEntity->getEmployeePostal(),
                'employeeIm' => $employeeEntity->getEmployeeIm(),
                'employeeImage' => $employeeEntity->getEmployeeImage(),
                'employeeStatus' => $employeeEntity->getEmployeeStatus(),
                'employeBirthday' => $employeeEntity->getEmployeBirthday(),
                'employeeMaritalStatus' => $employeeEntity->getEmployeeStatus(),
                'employeeWage' => $employeeEntity->getEmployeeWage(),
                'employeeSsn' => $employeeSsn
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
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
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
