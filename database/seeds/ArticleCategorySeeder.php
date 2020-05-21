<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('labels')->insert(
		    [
			    [
				    'user_id' => 1,
				    'name' => 'PHP',
				    'article_num' => 0,
			    ],
			    [
				    'user_id' => 1,
				    'name' => '闲文随笔',
				    'article_num' => 0
			    ]
		    ]
	    );
    }
}
