<?php namespace models\ClassAssignment;
/*
*
*@author NgocNguyen
*Total : 14
*Status : 14 OK FAIL 0
*
*
* TO-DO-LIST
1.Get List Engineer in class assignment table with empty class id.
2.Get List Engineer in class assignment table with class id is string.
3.Get List Engineer in class assignment table with class_id is not exist in database.
4.Assign Engineeer with empty class id and engineer id
5.Assign Engineeer with empty class id
6.Assign Engineeer with class id is string
7.Assign Engineeer with class id is not exist in database
8.Assign Engineeer with empty engineer id
9.Assign Engineeer with engineer id is string
10.Assign Engineeer with engineer id is not exist in database
*/

class ClassAssignmentsTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $params;

    protected $dataExpert = [
        ['class_id'=> 1,'engineer_id'=> 2],
    ];

    protected function _before()
    {
        $this->tester = new \ClassAssignments();
        $this->tester->fill($this->dataExpert);
    }

    protected function _after()
    {
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenGetListEngineerByClassIdIsString
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenGetListEngineerByClassIdIsString()
    {
        //GIVEN
        $class_id = 'it is a string token';
        //WHEN
        $results = $this->tester->getListById($class_id);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnEmptyWhenGetListEngineerByClassIdIsEmpty
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnEmptyWhenGetListEngineerByClassIdIsNotExistInDatabase()
    {
        //GIVEN
        $class_id = 1000;
        //WHEN
        $results = $this->tester->getListById($class_id);
        //THEN
        $this->assertEmpty($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenGetListEngineerByClassIdIsEmpty
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenGetListEngineerByClassIdIsEmpty()
    {
        //GIVEN
        $class_id = null;
        //WHEN
        $results = $this->tester->getListById($class_id);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnArrayWhenGetListEngineerByValidClassId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnArrayWhenGetListEngineerByValidClassId()
    {
        //GIVEN
        $class_id = 1;
        //WHEN
        $results = $this->tester->getListById($class_id);
        //THEN
        $this->assertNotEmpty($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnTrueWhenAssignEngineerWithValidClassIdAndEngineerId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnTrueWhenAssignEngineerWithValidClassIdAndEngineerId()
    {
        //GIVEN
        $this->params = $this->dataExpert;
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertTrue($results);
    }
    /**
     * @author NgocNguyen
     * @name testShouldReturnTrueWhenAssignEngineerWithValidClassIdAndEngineerId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenAssignEngineerWithEmptyEngineerId()
    {
        //GIVEN
        $this->params = [
            'class_id'=> 1,
            'engineer_id'=> null
        ];
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenAssignEngineerWithEmptyClassId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenAssignEngineerWithEmptyClassId()
    {
        //GIVEN
        $this->params = [
            'class_id'=> null,
            'engineer_id'=> 1
        ];
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenAssignEngineerWithEmptyClassIdAndEngineerId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenAssignEngineerWithEmptyClassIdAndEngineerId()
    {
        //GIVEN
        $this->params = [
            'class_id'=> null,
            'engineer_id'=> null
        ];
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenAssignEngineerWithClassIdIsNotExistInDatabase
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenAssignEngineerWithClassIdIsNotExistInDatabase()
    {
        //GIVEN
        $this->params = [
            'class_id'=> 1000,
            'engineer_id'=> 1
        ];
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenAssignEngineerWithClassIdIsString
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenAssignEngineerWithClassIdIsString()
    {
        //GIVEN
        $this->params = [
            'class_id'=> 'it is a token string',
            'engineer_id'=> 1
        ];
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenAssignEngineerWithEngineerIdIsString
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenAssignEngineerWithEngineerIdIsString()
    {
        //GIVEN
        $this->params = [
            'class_id'=> 1,
            'engineer_id'=> 'it is a token string'
        ];
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenAssignEngineerWithEngineerIdIsNotExistInDatabase
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenAssignEngineerWithEngineerIdIsNotExistInDatabase()
    {
        //GIVEN
        $this->params = [
            'class_id'=> 1,
            'engineer_id'=> 1000
        ];
        //WHEN
        $results = $this->tester->excuteSave($this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenRemoveAssignEngineerWithEmptyClassId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenRemoveAssignEngineerWithEmptyClassId()
    {
        //GIVEN
        $class_id = null;
        $this->params = [
            'class_id'=> 1,
            'engineer_id'=> 1000
        ];
        //WHEN
        $results = $this->tester->excuteDelete($class_id,$this->params);
        //THEN
        $this->assertFalse($results);
    }

    /**
     * @author NgocNguyen
     * @name testShouldReturnFalseWhenRemoveAssignEngineerWithEmptyEngineerId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenRemoveAssignEngineerWithEmptyEngineerId()
    {
        //GIVEN
        $class_id = 1;
        $this->params = [];
        //WHEN
        $results = $this->tester->excuteDelete($class_id,$this->params);
        //THEN
        $this->assertFalse($results);
    }

}