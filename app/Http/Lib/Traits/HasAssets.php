<?php


namespace App\Http\Lib\Traits;


use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

trait HasAssets
{
	
	
	/**
	 * @var array
	 */
	public static $css = [];
	
	
	public static $js = [];
	
	
	public static $jQuery = 'adminlte/plugins/jquery/jquery.min.js';
	
	
	/**
	 * @var string
	 */
	public static $manifest = '';
	
	
	/**
	 * @var array
	 */
	public static $manifestData = [];
	/**
	 * @var array
	 */
	public static $baseCss = [
		'adminlte/plugins/fontawesome-free/css/all.min.css',
		'adminlte/plugins/fontawesome-free/css/v4-shims.min.css',
		'adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
		'adminlte/css/adminlte.min.css',
		'adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
		'adminlte/plugins/daterangepicker/daterangepicker.css',
		'adminlte/plugins/toastr/toastr.min.css',
		'adminlte/plugins/nprogress/nprogress.css',
		
		'adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
		'adminlte/plugins/select2/css/select2.min.css',
		'adminlte/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css',
		'adminlte/plugins/dropzone/min/basic.min.css',
		'adminlte/plugins/dropzone/min/dropzone.min.css',
		'adminlte/plugins/sweetalert2/sweetalert2.min.css',
		'adminlte/plugins/sweetalert2-theme-wordpress-admin/wordpress-admin.min.css',
		'css/admin.css',
		
	];
	
	/**
	 * @var array
	 */
	public static $baseJs = [
		'adminlte/plugins/jquery-ui/jquery-ui.min.js',
		'adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js',
		'adminlte/plugins/jquery-pjax2/jquery.pjax.js',
		'adminlte/plugins/toastr/toastr.min.js',
		'adminlte/plugins/moment/moment.min.js',
		'adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
		'adminlte/js/adminlte.js',
		'adminlte/plugins/nprogress/nprogress.js',
		
		'adminlte/plugins/select2/js/select2.min.js',
		'adminlte/plugins/select2/js/i18n/zh-CN.js',
		'adminlte/plugins/bootstrap-markdown/js/bootstrap-markdown.js',
		'adminlte/plugins/bootstrap-markdown/locale/bootstrap-markdown.zh.js',
		'adminlte/plugins/bootstrap-markdown/js/hyperdown.min.js',
		'adminlte/plugins/sweetalert2/sweetalert2.min.js',
		'adminlte/plugins/dropzone/min/dropzone.min.js',
		'adminlte/plugins/dropzone/min/dropzone-amd-module.min.js',
		
		'js/admin.js',
		
	];
	
	/**
	 * @var array
	 */
	public static $minifyIgnores = [];
	
	/**
	 * @param null $js
	 * @param bool $minify
	 *
	 * @return array|null
	 */
	public static function baseJs($js = null, $minify = true)
	{
		static::ignoreMinify($js, $minify);
		
		if (!is_null($js)) {
			return static::$baseJs = $js;
		}
		
		return static::$baseJs;
	}
	
	/**
	 * @param string $assets
	 * @param bool   $ignore
	 */
	public static function ignoreMinify($assets, $ignore = true)
	{
		if (!$ignore) {
			static::$minifyIgnores[] = $assets;
		}
	}
	
	
	/**
	 * @param null $css
	 * @param bool $minify
	 *
	 * @return array|null
	 */
	public static function baseCss($css = null, $minify = true)
	{
		static::ignoreMinify($css, $minify);
		
		if (!is_null($css)) {
			return static::$baseCss = $css;
		}
		
		return static::$baseCss;
	}
	
	
	/**
	 * Add css or get all css.
	 *
	 * @param null $css
	 * @param bool $minify
	 *
	 * @return array|Factory|View
	 */
	public static function css($css = null, $minify = true)
	{
		static::ignoreMinify($css, $minify);
		
		if (!is_null($css)) {
			return self::$css = array_merge(self::$css, (array) $css);
		}
		
		if (!$css = static::getMinifiedCss()) {
			$css = array_merge(static::$css, static::baseCss());
		}
		
		$css = array_filter(array_unique($css));
		
		return view('admin.layouts.partials.css', compact('css'));
	}
	
	
	/**
	 * Add js or get all js.
	 *
	 * @param null $js
	 * @param bool $minify
	 *
	 * @return array|Factory|View
	 */
	public static function js($js = null, $minify = true)
	{
		static::ignoreMinify($js, $minify);
		
		if (!is_null($js)) {
			return self::$js = array_merge(self::$js, (array) $js);
		}
		
		if (!$js = static::getMinifiedJs()) {
			$js = array_merge(static::baseJs(), static::$js);
		}
		
		$js = array_filter(array_unique($js));
		
		return view('admin.layouts.partials.js', compact('js'));
	}
	
	/**
	 * @return bool|mixed
	 */
	protected static function getMinifiedJs()
	{
		if (!config('admin.minify_assets') || !file_exists(public_path(static::$manifest))) {
			return false;
		}
		
		return static::getManifestData('js');
	}
	
	
	/**
	 * @return bool|mixed
	 */
	protected static function getMinifiedCss()
	{
		if (!config('admin.minify_assets') || !file_exists(public_path(static::$manifest))) {
			return false;
		}
		
		return static::getManifestData('css');
	}
	
	/**
	 * @param string $key
	 *
	 * @return mixed
	 */
	protected static function getManifestData($key)
	{
		if (!empty(static::$manifestData)) {
			return static::$manifestData[$key];
		}
		
		static::$manifestData = json_decode(
			file_get_contents(public_path(static::$manifest)),
			true
		);
		
		return static::$manifestData[$key];
	}
	
	/**
	 * @return string
	 */
	public function jQuery()
	{
		return static::$jQuery;
	}
}