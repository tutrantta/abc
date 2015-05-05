<?php
//namespace models;

class InterviewValidateTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $objInterview;

    protected function _before()
    {
        $this->objInterview = new \Interview();
    }
    
    protected function _after()
    {
    }
    public function testShouldReturnMessageWhenNotSelectWorkingArea()
    {
        // GIVEN
        \Input::merge(['working_area_id' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The applied skill field is required.";
        $actual = $result->first('working_area_id');
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenHaveNotEngineerId()
    {
        // GIVEN
        \Input::merge(['engineer_id' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The engineer id field is required.";
        $actual = $result->first('engineer_id');
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenInterviewerNull()
    {
        // GIVEN
        \Input::merge(['interviewer' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The interviewer field is required.";
        $actual = $result->first('interviewer');
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenInterviewerGreaterThan50Chars()
    {
        // GIVEN
        $field = 'interviewer';
        $max = 50;
        \Input::merge([$field => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The ".$field." may not be greater than ".$max." characters.";
        $actual = $result->first($field);
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenDepartmentInterviewerNull()
    {
        // GIVEN
        \Input::merge(['interviewer_department' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The interviewer department field is required.";
        $actual = $result->get('interviewer_department')[0];
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenDepartmentInterviewerGreaterThan100Chars()
    {
        // GIVEN
        $field = 'interviewer_department';
        $max = 100;
        $chars = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        \Input::merge([$field => $chars]);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The interviewer department may not be greater than ".$max." characters.";
        $actual = $result->first($field);
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenAppliedPositionNotSelect()
    {
        // GIVEN
        \Input::merge(['applied_position' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The applied position field is required.";
        $actual = $result->get('applied_position')[0];
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenTechFeedbackNotSelect()
    {
        // GIVEN
        \Input::merge(['technique_skill_feedback' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The technique skill feedback field is required.";
        $actual = $result->get('technique_skill_feedback')[0];
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenManagementFeedbackNotSelect()
    {
        // GIVEN
        \Input::merge(['management_skill_feedback' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The management skill feedback field is required.";
        $actual = $result->get('management_skill_feedback')[0];
        // THEN
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnMessageWhenInterviewDateNotSelect()
    {
        // GIVEN
        \Input::merge(['interview_date' => '']);
        // WHEN
        $result = $this->objInterview->validation();
        $expected = "The interview date field is required.";
        $actual = $result->get('interview_date')[0];
        // THEN
        $this->assertEquals($expected, $actual);
    }

}