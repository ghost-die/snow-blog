<?php

return [
//	"upload_images" =>,

	"title" => '听雪阁',
	"min-logo"=>"/adminlte/image/logo.png",
	"logo" =>'听雪阁',
	'class' => "hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed font-weight-lighter",
	"https"=>true,
	"secure"=>true,
	"route" => [
		'prefix' => 'admin'
	],
	'menu' =>[
				[
					'id'=>1,
					'parent_id'=>0,
					'order'=>0,
					'title'=>'Dashboard',
					'icon'=>'fas fa-th-large',
					'uri'=>'/',
				],
				[
					'id'=>2,
					'parent_id'=>0,
					'order'=>0,
					'title'=>'User Profile',
					'icon'=>'fa fa-user',
					'uri'=>'user',
				],
				[
					'id'=>3,
					'parent_id'=>0,
					'order'=>0,
					'title'=>'Category',
					'icon'=>'fa fa-list',
					'uri'=>'category',
				],
				[
					'id'=>4,
					'parent_id'=>0,
					'order'=>0,
					'title'=>'Article Management',
					'icon'=>'fa fa-ticket',
					'uri'=>'#',
				],
				[
					'id'=>5,
					'parent_id'=>4,
					'order'=>0,
					'title'=>'Article List',
					'icon'=>'fa fa-ticket',
					'uri'=>'article',
				],
				[
					'id'=>6,
					'parent_id'=>4,
					'order'=>0,
					'title'=>'Article Comment',
					'icon'=>'fa fa-comment',
					'uri'=>'comment',
				],
				[
					'id'=>7,
					'parent_id'=>0,
					'order'=>0,
					'title'=>'Link',
					'icon'=>'fa fa-link',
					'uri'=>'link',
				]
			]

];