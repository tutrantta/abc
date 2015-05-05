<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soft_skills', function(Blueprint $table) {
			$table->increments('soft_skill_id');
			$table->string('soft_skill_name', 100);
			$table->text('soft_skill_description')->nullable();
			$table->boolean('is_active')->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('soft_skills');
	}

}
