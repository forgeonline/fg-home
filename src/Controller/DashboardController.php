<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * DashboardController
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

use Zend\Authentication\AuthenticationService;
use Interop\Container\ContainerInterface;

/**
 * DashboardController Class
 *
 * @category Controller
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class DashboardController extends AdminController
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
		parent::__construct($this->container);
	}
	
    /**
    * Process action
    *
    * @return object
    */
    public function indexAction()
    {
		$this->getAdminHeader();
		$this->getAdminSidebarmenu();
//		$this->getAdminFooter();
		$layout = $this->layout();
		$layout->setTemplate('dashboard/index/layout');
    }

}
