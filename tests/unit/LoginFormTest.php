<?php

use app\models\LoginForm;

class LoginFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LoginForm
     */
    protected $_form;

    protected function setUp()
    {
        $this->_form = new \app\models\LoginForm();
    }

    protected function tearDown()
    {
    }

    // tests
    public function testNoLoginFormData()
    {
        $this->assertFalse($this->_form->validate(), "Если фолма логина не заполнена. Валидация не прошла.");
    }

    public function testEmptyEmail()
    {
        $this->_form->load(array(
            'email' => '',
            'password' => 'sdadasdasd',
            'rememberMe' => false,
        ));
        $this->assertFalse($this->_form->validate(), "Если не указан email. Валидация не прошла.");
    }

    public function testEmptyPassword()
    {
        $this->_form->load(array(
            'email' => 'test@test.com',
            'password' => '',
            'rememberMe' => false,
        ));
        $this->assertFalse($this->_form->validate(), "Если не указан пароль. Валидация не прошла.");
    }
    public function testBadEmail()
    {
        $this->_form->load(array(
            'email' => 'test',
            'password' => 'asdasdasdasd',
            'rememberMe' => false,
        ));
        $this->assertFalse($this->_form->validate(), "Если указан неправильный email. Валидация не прошла.");
    }


}