<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function($table)
	{
	    $table->engine = 'InnoDB';

	    $table->increments('id');
	    $table->string('type', 100)->index();
	    $table->string('title');
	    $table->text('description');
	    $table->string('image', 100);
            $table->integer('position');
            $table->boolean('active')->default(0);
	    $table->integer('weight')->index();
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
	Schema::drop('categories');
    }

}
