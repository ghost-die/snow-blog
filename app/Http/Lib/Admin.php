<?php


namespace App\Http\Lib;


use App\Http\Lib\Traits\HasAssets;

class Admin
{
	use HasAssets,\App\Http\Lib\Traits\Tree;
	
	/**
	 * The admin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.1';
	
	/**
	 * @var []Closure
	 */
	protected static $bootingCallbacks = [];
	
	
	/**
	 * @var []Closure
	 */
	protected static $bootedCallbacks = [];
	
	/**
	 * Returns the long version of Laravel-admin.
	 *
	 * @return string The long application version
	 */
	public static function getLongVersion()
	{
		return sprintf(' <b>Version</b> <info>%s</info>', self::VERSION);
	}
	
	
	
	/**
	 * Bootstrap the admin application.
	 */
	public function bootstrap()
	{
		$this->fireBootingCallbacks();
		
		require config('ghost.bootstrap', app_path('Http/Lib/bootstrap.php'));
		
//		$this->addAdminAssets();
		
		$this->fireBootedCallbacks();
	}
	
	
	/**
	 * Call the booting callbacks for the admin application.
	 */
	protected function fireBootingCallbacks()
	{
		foreach (static::$bootingCallbacks as $callable) {
			call_user_func($callable);
		}
	}
	
	
	/**
	 * Call the booted callbacks for the admin application.
	 */
	protected function fireBootedCallbacks()
	{
		foreach (static::$bootedCallbacks as $callable) {
			call_user_func($callable);
		}
	}
	
	/**
	 * Left sider-bar menu.
	 *
	 * @return array
	 */
	public function menu()
	{
		if (!empty($this->menu)) {
			return $this->menu;
		}
		
		return $this->setMenu(config('ghost.menu'))->toTree();
	}
	
	
	
	public function toUrl(&$array)
	{
		
		foreach ($array as $k=>&$v)
		{
			$v = admin_url($v);
		}
		return $array;
	}
}