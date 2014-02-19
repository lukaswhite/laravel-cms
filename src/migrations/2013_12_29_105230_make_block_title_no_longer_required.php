<?php

use Illuminate\Database\Migrations\Migration;

class MakeBlockTitleNoLongerRequired extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blocks', function($table)
		{
			$table->dropColumn('title');			
		});

		Schema::table('blocks', function($table)
		{			
			$table->string('title', 255)->nullable();			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blocks', function($table)
		{
			$table->dropColumn('title');			
		});

		Schema::table('blocks', function($table)
		{			
			$table->string('title', 255);			
		});
	}

}