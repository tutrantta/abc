<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes', function(Blueprint $table) {
			$table->increments('class_id');
			$table->integer('course_id')->unsigned();
			$table->integer('trainer_id')->unsigned()->nullable();
			$table->string('class_name', 100);
			$table->date('date');
			$table->double('duration', 15, 2)->nullable();
			$table->boolean('has_examination')->nullable()->default(0);
			$table->timestamps();

			//foreign key
			$table->foreign('course_id')
				->references('course_id')
				->on('courses');
			$table->foreign('trainer_id')
				->references('trainer_id')
				->on('trainers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classes');
	}

}
