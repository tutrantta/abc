<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('engineers', function(Blueprint $table) {
			$table->increments('engineer_id');
			$table->string('employee_code', 20);
			$table->integer('department_id')->unsigned()->nullable();
			$table->string('fullname', 50);
			$table->date('birthday')->nullable();
			$table->text('email')->nullable();
			$table->text('address')->nullable();
			$table->string('phone', 20)->nullable();
			$table->text('other_information')->nullable();
			$table->char('gender', 1)->nullable();
			$table->boolean('is_active')->default(1);
			$table->boolean('has_interview_form')->default(0);
			$table->timestamps();

			//foreign key
			$table->foreign('department_id')
				->references('department_id')->on('departments')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('engineers');
	}

}

