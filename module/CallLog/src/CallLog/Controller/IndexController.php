<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use CallLog\Service\LogServiceInterface;


class IndexController extends BaseController
{
    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     *
     * @var LogServiceInterface
     */
    protected $logService;
    
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param LogServiceInterface $logService
     * @param LogForm $logForm
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService)
    {
        $this->clientService = $clientService;
    
        $this->logService = $logService;
        
        
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // client id
        $id = $this->params()->fromRoute('clientId');
    
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        // get client
        $clientEntity = $this->clientService->get($id);
    
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
    
            return $this->redirect()->toRoute('client-index');
        }
        
        $filter = array(
            'clientId' => $id
        );
        
        $paginator = $this->logService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'List Call Log for ' . $clientEntity->getClientName());
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Call Log');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-index');
        
        return new ViewModel(array(
            'clientId' => $id,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(),
        ));
    }
}