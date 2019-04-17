<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRequestsTable.
 */
class CreateRequestsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table) {
            $table->increments('id');
			//request information
			$table->integer('user_id')->unsined();
			$table->string('status', 20);
			$table->timestamps();
			//foreign key
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('', function (Blueprint $table){
			$table->dropForeign('request_userid_foreign');
		});
		Schema::drop('requests');
	}
}
