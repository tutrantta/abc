<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineerSoftSkillLevelHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('engineer_soft_skill_level_history', function(Blueprint $table) {
			$table->integer('engineer_id')->unsigned();
			$table->integer('soft_skill_id')->unsigned();
			$table->date('updated_time');
			$table->tinyInteger('soft_skill_level');
			$table->boolean('is_current');
			$table->boolean('is_first_update');
			$table->timestamps();

			//foreign key
			$table->foreign('engineer_id')
				->references('engineer_id')->on('engineers')
				->onDelete('cascade');
			$table->foreign('soft_skill_id')
				->references('soft_skill_id')
				->on('soft_skills')->onDelete('cascade');

			//primary key
			$table->primary(['engineer_id', 'soft_skill_id', 'updated_time'], 'long_softskill_primary_key');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('engineer_soft_skill_level_history');
	}

}
