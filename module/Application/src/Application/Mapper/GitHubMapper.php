<?php
namespace Application\Mapper;

use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Application\Entity\GitHubEntity;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;


class GitHubMapper implements GitHubMapperInterface
{
    protected $hydrator;
    
    protected $prototype;
    
    public function __construct(HydratorInterface $hydrator, GitHubEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }
    
    public function getIssues()
    {
        $request = new Request();
        
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        
        $request->setUri('https://api.github.com/repos/pacificnm/pnm/issues');
        
        $request->setMethod('GET');

        
        $client = new Client();
        
        $response = $client->dispatch($request);
        
        $dataSet = json_decode($response->getBody(), true);
        
       
        $resultSet = array();

        foreach ($dataSet as $key => $data) {
            $resultSet[$key] = $this->hydrator->hydrate($data, new GitHubEntity());
        }

        $paginatorAdapter = new ArrayAdapter($resultSet);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }
    
    public function getMilestones()
    {
        
    }
}

