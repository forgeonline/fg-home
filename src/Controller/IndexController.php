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
use Zend\View\Model\ViewModel;

/**
 * Index Controller Class
 *
 * @category Controller
 * @package  ZbeCore
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class IndexController extends AbstractActionController
{
    /**
    * Index action
    *
    * @return object
    */
    public function indexAction()
    {
        return new ViewModel();
    }
}
