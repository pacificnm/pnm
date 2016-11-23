<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Controller;

use Application\Controller\BaseController;
use Employee\Service\EmployeeServiceInterface;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;
use Employee\Form\EmployeeForm;
use Employee\Form\ProfileForm;
use Employee\Form\PasswordForm;
use Zend\Crypt\Password\Bcrypt;
use Zend\Crypt\BlockCipher;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class UpdateController extends BaseController
{

    /**
     *
     * @var EmployeeServiceInterface
     */
    protected $employeeService;

    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     *
     * @var EmployeeForm
     */
    protected $employeeForm;

    /**
     *
     * @var ProfileForm
     */
    protected $profileForm;

    /**
     *
     * @var PasswordForm
     */
    protected $passwordForm;

    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @var BlockCipher
     */
    protected $blockCipher;
    

    /**
     *
     * @param EmployeeServiceInterface $employeeService            
     * @param AuthServiceInterface $authService            
     * @param EmployeeForm $employeeForm            
     * @param ProfileForm $profileForm            
     * @param PasswordForm $passwordForm            
     */
    public function __construct(EmployeeServiceInterface $employeeService, AuthServiceInterface $authService, EmployeeForm $employeeForm, ProfileForm $profileForm, PasswordForm $passwordForm, array $config)
    {
        $this->employeeService = $employeeService;
        
        $this->authService = $authService;
        
        $this->employeeForm = $employeeForm;
        
        $this->profileForm = $profileForm;
        
        $this->passwordForm = $passwordForm;
        
        $this->config = $config;
        
        // encrypt ssi number
        $this->blockCipher = BlockCipher::factory('mcrypt', array(
            'algo' => 'aes'
        ));
        
        $this->blockCipher->setKey($this->config['encryption-key']);
    }

    /**
     * Admin Update
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('employeeId');
        
        $employeeEntity = $this->employeeService->get($id);
        
        if (! $employeeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the employee #' . $id);
            
            return $this->redirect()->toRoute('employee-index');
        }
        
        // update auth
        $authEntity = $this->authService->get($employeeEntity->getAuthEntity()
            ->getAuthId());
        
        if (! $authEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the authEntity');
            
            return $this->redirect()->toRoute('employee-index');
        }
        
        // if we have a post
        if ($this->getRequest()->isPost()) {
            
            // set form data
            $this->employeeForm->setData($this->getRequest()
                ->getPost());
            
            // if we are valid
            if ($this->employeeForm->isValid()) {
                
                // save employee entity
                $entity = $this->employeeForm->getData();
                
                // set birthday
                $entity->setEmployeBirthday(strtotime($entity->getEmployeBirthday()));
                
                // encrypt ssi
                $entity->setEmployeeSsn($this->blockCipher->encrypt($entity->getEmployeeSsn()));
                
                $employeeEntity = $this->employeeService->save($entity);
                
                // update auth
                // @todo move to trigger
                $authEntity->setAuthEmail($employeeEntity->getEmployeeEmail());
                
                $authEntity->setAuthName($employeeEntity->getEmployeeName());
                
                $this->authService->save($authEntity);
                
                // set flash messenger
                $this->flashmessenger()->addSuccessMessage('The employee was saved');
                
                return $this->redirect()->toRoute('employee-view', array(
                    'employeeId' => $id
                ));
            }
        }
        
        // bind form
        $employeeEntity->setEmployeBirthday(date("m/d/Y", $employeeEntity->getEmployeBirthday()));
        
        $employeeEntity->setEmployeeSsn($this->blockCipher->decrypt($employeeEntity->getEmployeeSsn()));
        
        $this->employeeForm->bind($employeeEntity);
        
        // return view
        return new ViewModel(array(
            'employeeEntity' => $employeeEntity,
            'form' => $this->employeeForm
        ));
    }

    /**
     * Employee Edit
     * 
     * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
     */
    public function employeeAction()
    {
        $authEntity = $this->authService->get($this->identity()
            ->getAuthId());
        
        $employeeEntity = $this->employeeService->get($this->identity()
            ->getEmployeeId());
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->profileForm->setData($postData);
            
            // if we are valid
            if ($this->profileForm->isValid()) {
                
                $employeeEntity = $this->profileForm->getData();
                
                $employeeEntity = $this->employeeService->save($employeeEntity);
                
                $authEntity->setAuthEmail($employeeEntity->getEmployeeEmail());
                
                $authEntity->setAuthName($employeeEntity->getEmployeeName());
                
                $this->authService->save($authEntity);
                
                $this->flashmessenger()->addSuccessMessage('Your information was saved');
                
                return $this->redirect()->toRoute('employee-profile');
            }
        }
        
        $this->profileForm->bind($employeeEntity);
        
        $this->layout()->setVariable('pageTitle', 'My Profile');
        
        $this->layout()->setVariable('pageSubTitle', $this->identity()
            ->getAuthName());
        
        $this->layout()->setVariable('activeMenuItem', 'employee');
        
        $this->layout()->setVariable('activeSubMenuItem', 'employee-profile');
        
        return new ViewModel(array(
            'form' => $this->profileForm
        ));
    }

    /**
     * Updates password
     * 
     * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
     */
    public function passwordAction()
    {
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->passwordForm->setData($postData);
            
            // if we are valid
            if ($this->passwordForm->isValid()) {
                
                $entity = $this->passwordForm->getData();
                
                $bcrypt = new Bcrypt();
                
                $authEntity = $this->authService->get($this->identity()
                    ->getAuthId());
                
                $password = $bcrypt->create($entity['newPassword']);
                
                $authEntity->setAuthPassword($password);
                
                $this->authService->save($authEntity);
                
                $this->flashmessenger()->addSuccessMessage('Your password has been changed, Please sign out to use your new password.');
                
                return $this->redirect()->toRoute('employee-profile');
            }
        }
        
        $this->passwordForm->get('employeeId')->setValue($this->identity()
            ->getEmployeeId());
        
        $this->layout()->setVariable('pageTitle', 'My Profile');
        
        $this->layout()->setVariable('pageSubTitle', 'Change Password');
        
        $this->layout()->setVariable('activeMenuItem', 'employee');
        
        $this->layout()->setVariable('activeSubMenuItem', 'employee-password');
        
        return new ViewModel(array(
            'form' => $this->passwordForm
        ));
    }
}
