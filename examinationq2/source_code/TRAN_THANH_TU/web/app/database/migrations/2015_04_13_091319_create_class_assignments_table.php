<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class_assignments', function (Blueprint $table) {
			$table->integer('engineer_id')->unsigned();
			$table->integer('class_id')->unsigned();
			$table->double('examination_result', 15, 2)->nullable();
			$table->boolean('pass_examination')->nullable();
			$table->timestamps();

			//foreign key
			$table->foreign('engineer_id')
				->references('engineer_id')->on('engineers')
				->onDelete('cascade');
			$table->foreign('class_id')
				->references('class_id')
				->on('classes')->onDelete('cascade');

			//primary key
			$table->primary(['engineer_id', 'class_id'], 'long_class_assignment_primary_key');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('class_assignments');
	}

}
