<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderCredit\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderCredit\Service\CreditServiceInterface;
use Workorder\Entity\WorkorderEntity;

/**
 * Get Work Order Credit View Helper
 *
 * @author jaimie (pacificnm@gmail.com)
 *        
 */
class GetWorkorderCredit extends AbstractHelper
{

    /**
     *
     * @var CreditServiceInterface
     */
    protected $creditService;

    /**
     *
     * @param CreditServiceInterface $creditService            
     */
    public function __construct(CreditServiceInterface $creditService)
    {
        $this->creditService = $creditService;
    }

    /**
     *
     * @param WorkorderEntity $workorderEntity            
     * @param string $displayLinks            
     */
    public function __invoke(WorkorderEntity $workorderEntity, $displayLinks = true)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $creditEntitys = $this->creditService->getWorkorderCredit($workorderEntity->getWorkorderId());
        
        $data->workorderEntity = $workorderEntity;
        
        $data->creditEntitys = $creditEntitys;
        
        $data->displayLinks = $displayLinks;
        
        $data->clientId = $workorderEntity->getClientId();
        
        return $partialHelper('partials/get-workorder-credit.phtml', $data);
    }
}

