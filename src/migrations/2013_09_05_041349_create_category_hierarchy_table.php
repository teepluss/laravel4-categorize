<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoryHierarchyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_hierarchy', function($table)
		{
			$table->engine = 'InnoDB';

		    $table->increments('id');
		    $table->integer('category_id')->unsigned()->index();
		    $table->integer('category_parent_id')->unsigned()->index();

		    $table->foreign('category_id')
      			  ->references('id')->on('categories')
      			  ->onDelete('cascade');

      		// $table->foreign('category_parent_id')
      		// 	  ->references('id')->on('categories')
      		// 	  ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_hierarchy');
	}

}