<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * LoginController
 *
 * PHP version 5
 *
 * @category Module
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
namespace FgHome\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result as Result;
use Zend\Authentication\AuthenticationService;
use FgHome\Form\FormLogin;
use FgHome\Model\LoginValidation;
use FgCore\Model\zbeMessage;
use FgCore\Manager\ConfigurationManager;
use Interop\Container\ContainerInterface;

/**
 * LoginController Class
 *
 * @category Controller
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class LoginController extends AbstractActionController
{
	/*
	* @var Zend\ServiceManager\ServiceLocatorInterface
	*/
	protected $services;
	
	/*
	* @var Interop\Container\ContainerInterface
	*/
	protected $container;
	
	protected $authService;
	
	/*
	* @var FgCore\Manager\ConfigurationManager
	*/
	protected $configurationManager;
	
	public function __construct(
		ConfigurationManager $configurationManager,
		ContainerInterface $container
	) {
		$this->configurationManager = $configurationManager;
		$this->container = $container;
		$this->authService = new AuthenticationService();
	}
	
    /**
    * Process action
    *
    * @return object
    */
    public function processAction()
    {
        $request = $this->getRequest();
        $message = new zbeMessage();
		if( $request->isPost() ){
            $loginForm = new FormLogin();
            $inputFilter = new LoginValidation();
            $loginForm->setInputFilter( $inputFilter->getInputFilter() );
            $loginForm->setData( $request->getPost() );
			
			if( $loginForm->isValid() ){
             	$post = $request->getPost();
                $configdata = $this->container->get('config');
                $username = trim($post['userlogin']);
                $salt = md5( $username );
				
				$p = sprintf("%s:%s",md5($configdata["production"]["encription_key"].$post['pw']),$salt);
				
				$adapter = $this->container->get('Zend\Db\Adapter\Adapter');
				$authadapter = new AuthAdapter($adapter);
				$authadapter->setTableName( "administrator" )
				->setIdentityColumn('admin_email')
				->setCredentialColumn('admin_password');
				
				$authadapter->setIdentity($username)->setCredential($p);
				$this->authService->setAdapter($authadapter);
				$result = $this->authService->authenticate();
				
				if ($result->isValid()) {
					return $this->redirect()->toRoute( 'dashboard' );
 				} else {
                    switch ($result->getCode()) {
                        case Result::FAILURE_IDENTITY_NOT_FOUND:
                            $msg = 'Incorrect credentials';
                            break;
                
                        case Result::FAILURE_CREDENTIAL_INVALID:
                            $msg = 'Invalid credentials';
                            break;
                
                        case Result::SUCCESS:
                            $msg = 'SUCCESS';
                            break;
                
                        default:
                            $msg = 'Incorrect credentials';
                            break;
                    }
                    $message->setError( $msg );
                    $this->redirectAdminIndex();
                }
				$configdata = $this->container->get('FgCore\Service\ConfigurationFactory');
            } else {
                $message->setError("faliure to validate.");
                $this->redirectAdminIndex();
            }
		} else {
			$this->redirectAdminIndex();
		}
		$layout = $this->layout();
		$layout->setTemplate('login/process/layout');
    }
	
	public function logoutAction(){
		$auth = new AuthenticationService();
		if($this->authService->hasIdentity()) {
			$this->authService->clearIdentity();
		}
		$this->redirectAdminIndex();
	}
	
    public function redirectAdminIndex(){
        return $this->redirect()->toRoute('home');
    }
}
