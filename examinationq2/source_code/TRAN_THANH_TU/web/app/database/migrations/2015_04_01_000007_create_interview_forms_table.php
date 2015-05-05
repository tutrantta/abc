<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview_forms', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('engineer_id')->unsigned();
			$table->tinyInteger('technique_skill_feedback');
			$table->tinyInteger('management_skill_feedback');
			$table->text('other_feedback')->nullable();
			$table->date('interview_date')->nullable();
			$table->integer('working_area_id')->unsigned();
			$table->text('interviewer');
			$table->text('interviewer_department');
            $table->tinyInteger('is_approve')->default(0);
			$table->timestamps();

			//foreign key
			$table->foreign('working_area_id')
				  ->references('working_area_id')
				  ->on('working_areas')->onDelete('cascade');
			$table->foreign('engineer_id')
				->references('engineer_id')
				->on('engineers')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interview_forms');
	}

}
