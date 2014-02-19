<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id');
			$table->integer('content_type_id');
			$table->string('title', 255);
			$table->string('slug', 255)->unique();
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
		Schema::drop('pages');
	}

}