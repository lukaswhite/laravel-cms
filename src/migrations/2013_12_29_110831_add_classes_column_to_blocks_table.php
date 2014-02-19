<?php

use Illuminate\Database\Migrations\Migration;

class AddClassesColumnToBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blocks', function($table)
		{
			$table->string('classes')->nullable();
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
			$table->dropColumn('classes');
		});
	}

}