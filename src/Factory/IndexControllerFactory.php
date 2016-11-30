<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * IndexControllerFactory
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
use FgHome\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * IndexControllerFactory Class
 *
 * @category Factory
 * @package  FgCore
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null)
    {
        return new IndexController($container);
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
		return $this($serviceLocator, 'FgHome\Factory\IndexControllerFactory');
     }
}