<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * AdminController
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
use Interop\Container\ContainerInterface;
use Zend\Mvc\MvcEvent;
use Zend\view\Model\ViewModel;

/**
 * AdminController Class
 *
 * @category Controller
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class AdminController extends AbstractActionController
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
	}

    /**
     * Execute the request
     *
     * @param  MvcEvent $e
     * @return mixed
     * @throws Exception\DomainException
     */
    public function onDispatch(MvcEvent $e)
    {
		$this->authService = new AuthenticationService();
        if(! $this->authService->hasIdentity()){
			$layout = $this->layout();
			$layout->setTemplate('login/process/layout');
            return $this->redirect()->toRoute('home');
        }
		parent::onDispatch($e);
    }

	public function getAdminHeader()
	{
		$view = new ViewModel();
		$view->setTemplate('admin/header');
		$this->layout()->addChild($view, 'adminheader');
	}
	
	public function getAdminSidebarMenu()
	{
		$content = array(
			'identity' => $this->authService->getIdentity()
		);
		$view = new ViewModel($content);
		$view->setTemplate('admin/sidebar/menu');
		$this->layout()->addChild($view, 'sidebar');
	}
	
	public function getAdminFooter()
	{
		$view = new ViewModel();
		$view->setTemplate('admin/footer');
		$this->layout()->addChild($view, 'footer');
	}
}
