<?php

use Illuminate\Database\Migrations\Migration;

class AddFormatColumnToPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pages', function($table)
		{			
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
		Schema::table('pages', function($table)
		{			
			$table->dropColumn('format');
		});
	}

}