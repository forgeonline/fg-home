<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * LoginControllerFactory
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
use FgHome\Controller\LoginController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * LoginControllerFactory Class
 *
 * @category Factory
 * @package  FgCore
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class LoginControllerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null)
    {
		$configService = $container->get('FgCore\Service\ConfigurationFactory');
        return new LoginController($configService, $container);
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
		return $this($serviceLocator, 'FgHome\Factory\LoginControllerFactory');
     }
}