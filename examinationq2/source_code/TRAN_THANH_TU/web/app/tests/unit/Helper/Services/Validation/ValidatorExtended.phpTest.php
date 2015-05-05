<?php
namespace Helper\Services\Validation;


class ValidatorExtendedTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $objTechnique;
    protected $dataExpect = [
            'name'=>'ngocnguyen',
    ];
    protected function _before()
    {
        $this->objTechnique = new \Technique();
        $this->objTechnique->fill($this->dataExpect);
    }

    protected function _after()
    {
    }

}