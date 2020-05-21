<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
	        $table->id();
	        $table->foreignId('article_id');
	        $table->bigInteger('parent_id')->default(0);
	        $table->longText('content');
	        $table->string('name');
	        $table->string('email');
	        $table->string('avatar');
	        $table->string('web_site')->default('#');
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
        Schema::dropIfExists('comments');
    }
}
