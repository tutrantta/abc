<?php namespace models;

/**
 * User Model test
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-05-06          tttu               Create File
 */

/**
 * To-do list
 * 1. function checkLogin should return false when username is empty string
 * 2. function checkLogin should return false when password is empty string
 * 3. function checkLogin should return false when both username and password are empty strings
 * 4. function checkLogin should return false when user info does not match database
 * 5. function checkLogin should return false when user info matches and user is not active
 * 6. function checkLogin should return true when user info matches and user is active
 */
class UserTest extends \Codeception\TestCase\Test
{
    protected $user;
    protected $activeUser = array(
        'id' => 1,
        'user_name' => 'tu',
        'first_name' => 'tu',
        'last_name' => 'tran',
        'isactive' => 1
    );
    protected $inactiveUser = array(
        'id' => 2,
        'user_name' => 'john',
        'first_name' => 'john',
        'last_name' => 'henry',
        'isactive' => 0
    );

    protected function _before()
    {
        $this->activeUser['password'] = hash('sha256', 'tu');
        $this->inactiveUser['password'] = hash('sha256', 'john');
        \DB::table('tbl_user')->truncate();
        \DB::table('tbl_user')->insert($this->activeUser);
        \DB::table('tbl_user')->insert($this->inactiveUser);
        $this->user = new \User();
    }

    protected function _after()
    {
    }

    // 1. function checkLogin should return false when username is empty string
    public function testCheckLoginShouldReturnFalseWhenUsernameIsEmptyString() {
        //GIVEN
        $username = '';
        $password = 'password';
        $arrData = [
            'user_name' => $username,
            'password' => $password,
        ];
        \Input::merge($arrData);
        $expectedErrors = ['The user name field is required.'];

        //WHEN
        $actual = $this->user->checkLogin($username, $password);
        $actualErrors = $this->user->errors()->all();

        //THEN
        $this->assertFalse($actual);
        $this->assertEquals($expectedErrors, $actualErrors);
    }

    // 2. function checkLogin should return false when password is empty string
    public function testCheckLoginShouldReturnFalseWhenPassWordIsEmptyString() {
        //GIVEN
        $username = 'username';
        $password = '';
        $arrData = [
            'user_name' => $username,
            'password' => $password,
        ];
        \Input::merge($arrData);
        $expectedErrors = ['The password field is required.'];

        //WHEN
        $actual = $this->user->checkLogin($username, $password);
        $actualErrors = $this->user->errors()->all();

        //THEN
        $this->assertFalse($actual);
        $this->assertEquals($expectedErrors, $actualErrors);
    }

    // 3. function checkLogin should return false when both username and password are empty strings
    public function testCheckLoginShouldReturnFalseWhenBothUsernameAndPassWordEmptyString() {
        //GIVEN
        $username = '';
        $password = '';
        $arrData = [
            'user_name' => $username,
            'password' => $password,
        ];
        \Input::merge($arrData);
        $expectedErrors = [
            'The user name field is required.',
            'The password field is required.'
        ];

        //WHEN
        $actual = $this->user->checkLogin($username, $password);
        $actualErrors = $this->user->errors()->all();

        //THEN
        $this->assertFalse($actual);
        $this->assertEquals($expectedErrors, $actualErrors);
    }

    // 4. function checkLogin should return false when user info does not match database
    public function testCheckLoginShouldReturnFalseWhenUserInfoNotMatchDatabase() {
        //GIVEN
        $username = 'username';
        $password = 'password';
        $arrData = [
            'user_name' => $username,
            'password' => $password,
        ];
        \Input::merge($arrData);
        $expectedErrors = ['Invalid Credentials!'];

        //WHEN
        $actual = $this->user->checkLogin($username, $password);
        $actualErrors = $this->user->errors()->all();

        //THEN
        $this->assertFalse($actual);
        $this->assertEquals($expectedErrors, $actualErrors);
    }

    // 5. function checkLogin should return false when user info matches and user is not active
    public function testCheckLoginShouldReturnFalseWhenUserInfoMatchDatabaseAndUserIsNotActive() {
        //GIVEN
        $username = 'john';
        $password = 'john';
        $arrData = [
            'user_name' => $username,
            'password' => $password,
        ];
        \Input::merge($arrData);
        $expectedErrors = ['Invalid Credentials!'];

        //WHEN
        $actual = $this->user->checkLogin($username, $password);
        $actualErrors = $this->user->errors()->all();

        //THEN
        $this->assertFalse($actual);
        $this->assertEquals($expectedErrors, $actualErrors);
    }

    // 6. function checkLogin should return true when user info matches and user is active
    public function testCheckLoginShouldReturnFalseWhenUserInfoMatchDatabaseAndUserIsActive() {
        //GIVEN
        $username = 'tu';
        $password = 'tu';
        $arrData = [
            'user_name' => $username,
            'password' => $password,
        ];
        \Input::merge($arrData);
        $expectedErrors = [];

        //WHEN
        $actual = $this->user->checkLogin($username, $password);
        $actualErrors = $this->user->errors()->all();

        //THEN
        $this->assertTrue($actual);
        $this->assertEquals($expectedErrors, $actualErrors);
    }
}