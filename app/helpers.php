<?php


use Carbon\Carbon;

if (! function_exists('randByMicrosecond')) {
	
	function randByMicrosecond( )
	{
		return Carbon::now()->timestamp.Carbon::now()->microsecond.mt_rand(0,9999);
	}
}

if(! function_exists('getMdFirstImageUrl')){
	function getMdFirstImageUrl(string $content)
	{
		$preg = '/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i';
		
		
		preg_match($preg,$content,$img);
		
		if (!empty($img[1]))
		{
			return $img[1];
		}else{
			return  '';
		}
	}
}

if(! function_exists('imageOriginalToCover')) {
	function imageOriginalToCover ( string $imageUrl )
	{
		return preg_replace( '/original/' , 'cover' , $imageUrl );
	}
}



if (! function_exists('stripTags')){
	//清除html标签
	function stripTags ( $content )
	{
		
		return preg_replace('/&nbsp;/',' ',strip_tags( $content ));
	}
}


if (!function_exists('admin_url')) {
	/**
	 * Get admin url.
	 *
	 * @param string $path
	 * @param mixed  $parameters
	 * @param bool   $secure
	 *
	 * @return string
	 */
	function admin_url($path = '', $parameters = [], $secure = null)
	{
		if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
			return $path;
		}
		
		$secure = $secure ?: (config('ghost.https') || config('ghost.secure'));
		
		return url(admin_base_path($path), $parameters, $secure);
	}
}

if (!function_exists('admin_base_path')) {
	/**
	 * Get admin url.
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	function admin_base_path($path = '')
	{
		$prefix = '/'.trim(config('ghost.route.prefix'), '/');
		
		$prefix = ($prefix == '/') ? '' : $prefix;
		
		$path = trim($path, '/');
		
		if (is_null($path) || strlen($path) == 0) {
			return $prefix ?: '/';
		}
		
		return $prefix.'/'.$path;
	}
}
if (!function_exists('make_gravatar')) {
	function make_gravatar ( string $email , int $size = 120 )
	{
		$hash = md5( $email );
		return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=identicon";
	}
}
