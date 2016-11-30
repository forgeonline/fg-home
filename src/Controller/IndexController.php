<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * IndexController
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
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result as Result;
use FgHome\Form\FormLogin;
use Zend\view\Model\ViewModel;
use FgHome\Model\LoginValidation;
use FgCore\Model\zbeMessage;
use Interop\Container\ContainerInterface;

/**
 * Index Controller Class
 *
 * @category Controller
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class IndexController extends AbstractActionController
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
		ContainerInterface $container
	) {
		$this->container = $container;
		$this->authService = new AuthenticationService();
	}
	
    /**
    * Index action
    *
    * @return object
    */
    public function indexAction()
    {
        if( $this->authService->hasIdentity() ){
            return $this->redirect()->toRoute( 'dashboard' );
        }
        $form = new FormLogin();
        return array('form' => $form );
    }
}
