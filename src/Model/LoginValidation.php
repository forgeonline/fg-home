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
namespace FgHome\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * LoginValidation Class
 *
 * @category Controller
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class LoginValidation implements InputFilterAwareInterface
{
    protected $inputfilter;
    
    public function exchangeArray($data){
        $this->userlogin     = (isset($data['userlogin']))     ? $data['userlogin']     : null;
        $this->pw = (isset($data['pw'])) ? $data['pw'] : null;
    }
    
    public function setInputFilter( InputFilterInterface $inputfilter){
        throw new \ErrorException("Loginvalidation set input filter is disabled");
    }
    
    public function getInputFilter(){
        if( !$this->inputfilter ){
            $inputfilter = new InputFilter();
            $inputfilter->add(array(
                'name'     => 'userlogin',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'EmailAddress',
                    ),
                    array(
                        'name' => 'NotEmpty',
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 50,
                        ),
                    ),
                ),
                
            ));
            $inputfilter->add(array(
                'name'     => 'pw',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 6,
                            'max' => 18
                        ),
                    ),
                ),
            ));
            $this->inputfilter = $inputfilter;
        }
        return $this->inputfilter;;
    }
}