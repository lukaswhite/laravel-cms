<?php

use Illuminate\Database\Migrations\Migration;

class ModifyBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blocks', function($table)
		{
			$table->string('admin_title');
			$table->string('format', 16);
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
			$table->dropColumn('admin_title');
			$table->dropColumn('format');
		});
	}

}