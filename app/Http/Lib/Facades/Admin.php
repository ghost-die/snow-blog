<?php

namespace App\Http\Lib\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Admin.
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void css($css = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void js($js = null)
 * @method static void bootstrap()
 * @method static menu()
 *
 * @see \App\Http\Lib\Admin
 */

class Admin extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \App\Http\Lib\Admin::class;
	}
}