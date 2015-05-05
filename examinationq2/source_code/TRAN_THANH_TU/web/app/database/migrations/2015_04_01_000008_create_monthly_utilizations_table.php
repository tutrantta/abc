<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyUtilizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('monthly_utilizations', function(Blueprint $table) {
			$table->integer('engineer_id')->unsigned();
			$table->integer('working_area_id')->unsigned();
			$table->date('month');
			$table->double('utilization', 15, 2);
			$table->timestamps();

			//foreign key
			$table->foreign('engineer_id')
				  ->references('engineer_id')->on('engineers')
				  ->onDelete('cascade');
			$table->foreign('working_area_id')
				  ->references('working_area_id')
				  ->on('working_areas')->onDelete('cascade');

			//primary key
			$table->primary(['engineer_id', 'working_area_id', 'month'], 'long_utilization_primary_key');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('monthly_utilizations');
	}

}
