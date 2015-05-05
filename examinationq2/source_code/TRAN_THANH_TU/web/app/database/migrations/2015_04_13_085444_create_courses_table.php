<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
			$table->increments('course_id');
			$table->integer('area_id')->unsigned();
			$table->string('course_name', 100);
			$table->text('description')->nullable();
			$table->timestamps();

			//foreign key
			$table->foreign('area_id')
				->references('area_id')
				->on('areas')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
