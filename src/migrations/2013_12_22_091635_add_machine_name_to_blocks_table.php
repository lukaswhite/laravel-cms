<?php

use Illuminate\Database\Migrations\Migration;

class AddMachineNameToBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blocks', function($table)
		{
			$table->string('machine_name')->unique();
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
		    $table->dropColumn('machine_name');
		});
	}

}