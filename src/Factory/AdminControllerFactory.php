<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * AdminControllerFactory
 *
 * PHP version 5
 *
 * @category Module
 * @package  FgCore
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
namespace FgHome\Factory;

use Interop\Container\ContainerInterface;
use FgHome\Controller\AdminController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * AdminControllerFactory Class
 *
 * @category Factory
 * @package  FgCore
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class AdminControllerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null)
    {
        return new AdminController($container);
    }
	
	/**
	* Create service
	*
	* @param ServiceLocatorInterface $serviceLocator
	*
	* @return mixed
	*/
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return $this($serviceLocator, 'FgHome\Factory\AdminControllerFactory');
     }
}