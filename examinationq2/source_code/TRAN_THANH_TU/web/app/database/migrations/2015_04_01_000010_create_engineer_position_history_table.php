<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineerPositionHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('engineer_position_history', function(Blueprint $table) {
			$table->integer('engineer_id')->unsigned();
			$table->integer('level_id')->unsigned();
			$table->date('updated_time');
			$table->boolean('is_current');
			$table->boolean('is_first_update');
			$table->timestamps();

			//foreign key
			$table->foreign('engineer_id')
				->references('engineer_id')->on('engineers')
				->onDelete('cascade');
			$table->foreign('level_id')
				->references('level_id')
				->on('levels')->onDelete('cascade');

			//primary key
			$table->primary(['engineer_id', 'level_id', 'updated_time'], 'long_position_primary_key');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('engineer_position_history');
	}

}
