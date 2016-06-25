<?php

namespace Install\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Install\Service\InstallServiceInterface;

class DatabaseController extends AbstractActionController
{
    /**
     *
     * @var InstallServiceInterface
     */
    protected $installService;
    
    /**
     * 
     * @param InstallServiceInterface $installService
     */
    public function __construct(InstallServiceInterface $installService)
    {
        $this->installService = $installService;
    }

    public function indexAction()
    {
        if(is_file('data/install')) {
            return $this->redirect()->toRoute('home');
        }
        
        
        // load all db files
        $it = new \RecursiveDirectoryIterator("module");
        
        $display = array(
            'sql'
        );
        
        foreach (new \RecursiveIteratorIterator($it) as $file) {
        
            $fileExt = explode('.', $file);
            
            $check = strtolower(array_pop($fileExt));

            if (in_array($check, $display)) {
        
                $sql = file_get_contents($file);
        
                $this->installService->installTabel($sql);
            }
        }
        
        return $this->redirect()->toRoute('install-config');
    }


}

