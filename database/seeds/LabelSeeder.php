<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelSeeder extends Seeder
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
				    'name' => 'php',
				    'num' => 0
			    ],
			    [
				    'name' => 'html',
				    'num' => 0
			    ],
			    [
				    'name' => 'js',
				    'num' => 0
			    ],
			    [
				    'name' => 'linux',
				    'num' => 0
			    ],
			    [
				    'name' => 'docker',
				    'num' => 0
			    ],
			    [
				    'name' => '服务器',
				    'num' => 0
			    ],
			    [
				    'name' => 'CentOS',
				    'num' => 0
			    ]
		    ]
	    );
    }
}
