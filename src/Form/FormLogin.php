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
namespace FgHome\Form;

use Zend\Form\Form;

/**
 * Form Class
 *
 * @category Controller
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class FormLogin extends Form
{
    public function __construct($name = null){
        parent::__construct();
        
        $this->add(array(
            'name' => 'secureprefix',
            'attributes' => array(
            	'type'  => 'hidden',
                'id' => 'secureprefix',
    				'class' => 'form-control input-admin',
    				'placeholder' => 'Password',
    				'autofocus' => 'autofocus'
            ),
        ));
        
        
        $this->add(array(
            'name' => 'userlogin',
            'type' => 'email',
            'attributes' => array(
                'class' => 'userlogin form-control',
                'id' => 'email',
                'required' => 'required'
            ),
            'options' => array( 'label' => 'Username')
        ));
        
        $this->add(array(
            'name' => 'pw',
            'type' => 'password',
            'attributes' => array(
                'class' => 'password form-control',
                'id' => 'password',
                'required' => 'required'
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Login',
                'id' => 'submitbutton',
            ),
        ));
    }   
}