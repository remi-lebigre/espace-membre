<?php namespace memberspace\model\test;

use memberspace\model\User;

class UserTest extends \PHPUnit_Framework_TestCase{

    protected function setUp(){
        $oUser = new User();
        $this->assertNotNull($oUser);			//s'assure que $oUser soit pas vide
    }

    public function testFirstName(){
        $oUser = new User();
        $oUser->setFirstName('test');
        $this->assertNotEmpty($oUser->getFirstName());
    }

    public function testLastName(){
        $oUser = new User();
        $oUser->setLastName('test');
        $this->assertNotEmpty($oUser->getLastName());
    }

    public function testJob(){
        $oUser = new User();
        $oUser->setJob('test');
        $this->assertNotEmpty($oUser->getJob());
        $this->assertInternalType('string',$oUser->getJob());
    }

    public function testAvatar(){
        $oUser = new User();
        $oUser->setAvatar('images/lorem.txt');
        $this->assertNotEmpty($oUser->getAvatar());
        $this->assertEquals('images/',substr($oUser->getAvatar(),0,7));
    }

    public function testRegisterDate(){
        $oUser = new User();
        $oUser->setRegisterDate(date('Y-m-d H:i:s'));
        $this->assertNotEmpty($oUser->getRegisterDate());
        $this->assertEquals('20',substr($oUser->getRegisterDate(),0,2));
    }

    public function testPassword(){
        $oUser = new User();
        $oUser->setPassword('test');
        $this->assertNotEmpty($oUser->getPassword());
    }

    public function testCryptedPassword(){
        $oUser = new User();
        $oUser->setPassword('test');
        $this->assertEquals(sha1($oUser->getPassword()),$oUser->getCryptedPassword());
    }

    public function testEmail(){
        $oUser = new User();
        $oUser->setEmail('test');
        $this->assertNotEmpty($oUser->getEmail());
    }

    public function testMaleGender(){
        $oUser = new User();
        $oUser->setGender('homme');
        $this->assertEquals($oUser->getGender(),'homme');
    }

    public function testFemaleGender(){
        $oUser = new User();
        $oUser->setGender('femme');
        $this->assertEquals($oUser->getGender(),'femme');
    }

    public function testId(){
        $oUser = new User();
        $oUser->setId(5);
        $this->assertInternalType('int',$oUser->getId());
    }

} 