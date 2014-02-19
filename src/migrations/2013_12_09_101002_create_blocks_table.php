<?php

use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blocks', function($table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id');			
			$table->string('title', 255);			
			$table->text('data')->nullable()->default(NULL);      
			$table->text('body')->nullable()->default(NULL);      
      $table->integer('status')->default('0');
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
		Schema::drop('blocks');
	}

}