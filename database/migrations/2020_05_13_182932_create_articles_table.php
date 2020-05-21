<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
	        $table->foreignId('user_id')->constrained()->onDelete('cascade');
	        $table->foreignId('category_id')->constrained('article_categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->longText('content');
            $table->integer('reads_num')->default(0);
            $table->integer('comments_num')->default(0);
            $table->string('author')->nullable();
	
	        $table->unique('id');
	        $table->index(['user_id','category_id','title','author']);
	        
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
        Schema::dropIfExists('articles');
    }
}
