<?php namespace models;
/*
*
*@author NgocNguyen
*Total : 55 function unit test
*Status : 55 OK 0 Fail
*
*
* TO-DO-LIST
1.Empty Username and Password.
2.Empty Username and valid Password.
3.Valid Username and empty Password
4.Invalid Username and invalid Password.
5.Valid Username and invalid Password.
6.Valid Username and Valid Password and Use Is Active
7.Valid Username and Password have specical characters
8.Username have special characters and valid Password
9.Valid Username and Password length more than sixty characters
10.Valid Username and Valid Password But User Not Active
11.Create User with empty any required field 
12.Create User with username exist in database
13.Create User with email exist in database
14.Create User with password and password confirm not match
15.Create User with length of password or password confirm small 3 characters
16.Update User with empty any required field 
17.Update User with username exist in database
18.Update User with email exist in database
19.Update User with password and password confirm not match
20.Update User with length of password or password confirm small 3 characters
21.Update User with role not admin
22.Update User with role admin
23.View Detail user with id null
24.View Detail user with id is not integer
25.View Detail user with id is not exist
26.Change password with wrong old password
27.Change password with empty old password, new password and password confirm
28.Change password with new password and password confirm not match
29.Change password with length of new password or password confirm not match
*/

class UserTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $params;

    protected $dataExpert = [
        'username'=>'admin1',
        'password'=>'123456',
        'is_active'=> 1
    ];

    protected $dataExpertUpdate = [
        'full_name'=>'vegeata',    
        'username'=>'ngocnguyen124124124124',
        'password'=> 'ngocnguyen',
        'password_confirmation'=>'ngocnguyen',
        'email'=>'ngocnguyen@gmail.com',
        'is_admin'=>'1',
        'is_active'=>'1'
    ];

    protected function _before()
    {
        $this->tester = new \User();
        $this->tester->fill($this->dataExpert);
    }

    protected function _after()
    {
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnTrueWhenInputUserNameAndPassWordExistInDatabase
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnTrueWhenInputUserNameAndPassWordExistInDatabaseAndUserIsActive()
    {
        //GIVEN   
        $this->params = $this->dataExpert;

        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertTrue($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenNotInputUserNameAndPassWord
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenNotInputUserNameAndPassWord()
    {
        //GIVEN   
        $this->params = [
            'username'=>null,
            'password'=>null,
            'is_active'=> 1
        ];
        
        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputUserNameAndNotInputPassWord
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputUserNameAndNotInputPassWord()
    {
        //GIVEN   
        $this->params = [
            'username'=>'ngocnguyen',
            'password'=>null,
            'is_active'=> 1
        ];
        
        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenNotInputUserNameAndInputPassWord
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenNotInputUserNameAndInputPassWord()
    {
        //GIVEN   
        $this->params = [
            'username'=>null,
            'password'=>'123456',
            'is_active'=> 1
        ];
        
        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputUserNameAndPassWordNotExistInDatabases
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputUserNameAndPassWordNotExistInDatabases()
    {
        //GIVEN   
        $this->params = [
            'username'=>'kaka',
            'password'=>'kekeke',
            'is_active'=> 1
        ];
        
        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputUserNameCorrectAndPassWordNotCorrect
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputUserNameCorrectAndPassWordNotCorrect()
    {
        //GIVEN   
        $this->params = [
            'username'=>'admin1',
            'password'=>'kekeke',
            'is_active'=> 1
        ];
        
        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputUserNameNotCorrectAndPassWordCorrect
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputUserNameNotCorrectAndPassWordCorrect()
    {
        //GIVEN   
        $this->params = [
            'username'=>'admin1234',
            'password'=>'123456',
            'is_active'=> 1
        ];

        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputUserNameNotCorrectAndPassWordCorrect
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputCorrectUserNameAndPassWordButUserNotActive()
    {
        //GIVEN   
        $this->params = [
            'username'=>'admin1',
            'password'=>'123456',
            'is_active'=>0,
        ];

        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputUserNameHaveSpecialCharacters
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputUserNameHaveSpecialCharacters()
    {
        //GIVEN   
        $this->params = [
            'username'=>'@#!$##@',
            'password'=>'123456',
            'is_active'=>1,
        ];

        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputUserNameAndPasswordHaveSpecialCharacters
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputUserNameAndPasswordHaveSpecialCharacters()
    {
        //GIVEN   
        $this->params = [
            'username'=>'#$#@!@',
            'password'=>'@#!%^&*',
            'is_active'=>1,
        ];

        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputPassWordHaveSpecialCharacters
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputPassWordHaveSpecialCharacters()
    {
        //GIVEN   
        $this->params = [
            'username'=>'admin1',
            'password'=>'@#!%^&*',
            'is_active'=>1,
        ];

        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenInputPassWordLenghtMoreThanSixtyCharacters
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputPassWordLenghtMoreThanSixtyCharacters()
    {
        //GIVEN   
        $this->params = [
            'username'=>'admin1',
            'password'=>'123456123456123456123456123456123456123456123456123456123456123456123456123
                            123456123456123456123456123456123456123456123456123456123456123456123456
                            123456123456123456123456123456123456123456123456123456123456123456123456',
            'is_active'=>1,
        ];

        // WHEN
        $results = $this->tester->checkLogin($this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnTrueWhenCreateNewUsers
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnTrueWhenCreateNewUsers()
    { 
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'ngocnguyencmu',
            'password'=>'123456',
            'password_confirmation'=>'123456',
            'email'=>'ngocnguyenssssscmu@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertTrue($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithEmptyUserName
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithEmptyUserName()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>null,
            'password'=>'123456',
            'password_confirmation'=>'123456',
            'email'=>'ngocnguyencmu@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }
    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithEmptyPassword
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithEmptyPassword()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'username',
            'password'=> null,
            'password_confirmation'=>'123456',
            'email'=>'ngocnguyencmu@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }
    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithEmptyPasswordConfirmation
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithEmptyPasswordConfirmation()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'username',
            'password'=> '123456',
            'password_confirmation'=>null,
            'email'=>'ngocnguyencmu@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }
    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithEmptyEmail
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithEmptyEmail()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'username',
            'password'=> '123456',
            'password_confirmation'=>'123456',
            'email'=>null,
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithWrongEmailFormat
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithWrongEmailFormat()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'username',
            'password'=> '123456',
            'password_confirmation'=>'123456',
            'email'=>'email-token',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithPasswordAndPasswordConfirmNotMatch
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithPasswordAndPasswordConfirmNotMatch()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'username',
            'password'=> '654321',
            'password_confirmation'=>'123456',
            'email'=>'ngocnguyencmu@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithUsernameExistInDatabase
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithUsernameExistInDatabase()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'admin1',
            'password'=> '123456',
            'password_confirmation'=>'123456',
            'email'=>'ngocnguyencmu@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithEmailExistInDatabase
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithEmailExistInDatabase()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'ngocnguyen',
            'password'=> '123456',
            'password_confirmation'=>'123456',
            'email'=>'admin1@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenCreateNewUsersWithPasswordAndPassWordConfirmLengthSmallSixCharacters
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenCreateNewUsersWithPasswordAndPassWordConfirmLengthSmallSixCharacters()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN   
        $this->params = [
            'full_name'=>'vegeta',
            'username'=>'ngocnguyen',
            'password'=> '123',
            'password_confirmation'=>'123',
            'email'=>'admin1@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];
        $this->tester->fill($this->params);
        // WHEN
        $results = $this->tester->excuteSave();
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnErrorMessageWhenUpdateUsersWithInValidParams
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnErrorMessageWhenUpdateUsersWithInValidParams()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN
        $data = $this->tester->first()->toArray();
        $id = $data['id'];
        $this->errorMessageExpert = [
            'The full name field is required.'
        ];
        $this->params = [
            'full_name'=>'',
            'username'=>'',
            'password'=> 'ngocnguyen',
            'password_confirmation'=>'ngocnguyen',
            'email'=>'ngocnguyen@gmail.com',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];      
        \Input::merge($this->params);
        // WHEN
        $results = $this->tester->excuteUpdate($id);
        // THEN
        $this->assertEquals($results->all(),$this->errorMessageExpert);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnErrorMessageWhenUpdateUsersWithEmptyEmail
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnErrorMessageWhenUpdateUsersWithEmptyEmail()
    {
        $this->tester->checkLogin($this->dataExpert);
        
        //GIVEN
        $data = $this->tester->first()->toArray();
        $id = $data['id'];
        $this->errorMessageExpert = [
            'The email field is required.'
        ];
        $this->params = [
            'full_name'=>'vegeta',
            'password'=> '123456',
            'password_confirmation'=>'123456',
            'email'=>'',
            'is_admin'=>'1',
            'is_active'=>'1'
        ];      
        \Input::merge($this->params);
        // WHEN
        $results = $this->tester->excuteUpdate($id);
        // THEN
        $this->assertEquals($results->all(),$this->errorMessageExpert);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenGetDetailUserWithEmptyId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenGetDetailUserWithEmptyId()
    {
        //GIVEN   
        $this->params = [
            'id'=>null,
        ];
        // WHEN
        $results = $this->tester->getDetail($this->params['id']);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnNullWhenGetDetailUserWithInvalidId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnNullWhenGetDetailUserWithInvalidId()
    {
        //GIVEN   
        $this->params = [
            'id'=>'thisIsATokenString',
        ];
        // WHEN
        $results = $this->tester->getDetail($this->params['id']);
        // THEN
        $this->assertNull($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnErrorMessageWhenUpdateUsersWithEmptyEmail
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnErrorMessageWhenChangePasswordWithInvalidParams()
    {
        $this->tester->checkLogin($this->dataExpert);
        //GIVEN
        $data = $this->tester->first()->toArray();
        $id = $data['id'];
        $this->errorMessageExpert = [
            'The password field is required.',
            'The password confirmation field is required.'
        ];
        $this->params = [
            'old_password'=>'123456',
            'password'=> '',
            'password_confirmation'=>'',
        ];      
        \Input::merge($this->params);
        // WHEN
        $results = $this->tester->changePassword($id);
        // THEN
        $this->assertEquals($results->all(),$this->errorMessageExpert);
    }
}