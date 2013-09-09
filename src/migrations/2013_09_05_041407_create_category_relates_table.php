<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoryRelatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_relates', function($table)
		{
			$table->engine = 'InnoDB';

		    $table->integer('category_id')->unsigned()->index();
		    $table->integer('contentable_id')->unsigned()->index();
		    $table->string('contentable_type', 100);

		    $table->primary(array('contentable_id', 'contentable_type'));

		    $table->foreign('category_id')
      			  ->references('id')->on('categories')
      			  ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_relates');
	}

}