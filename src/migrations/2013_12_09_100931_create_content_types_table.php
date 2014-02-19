<?php

use Illuminate\Database\Migrations\Migration;

class CreateContentTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_types', function($table)
		{
			$table->increments('id')->unsigned();			
			$table->string('name', 255);			
			$table->text('data')->nullable()->default(NULL);            
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
		Schema::drop('content_types');
	}

}