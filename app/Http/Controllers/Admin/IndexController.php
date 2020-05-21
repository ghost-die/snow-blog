<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Image as ImageModel;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class IndexController extends Controller
{
	public function index()
	{
		
		
		$envs = [
			['name' => 'PHP version',       'value' => 'PHP/'.PHP_VERSION],
			['name' => 'Laravel version',   'value' => app()->version()],
			['name' => 'CGI',               'value' => php_sapi_name()],
			['name' => 'Uname',             'value' => php_uname()],
			['name' => 'Server',            'value' => Arr::get($_SERVER, 'SERVER_SOFTWARE')],
			
			['name' => 'Cache driver',      'value' => config('cache.default')],
			['name' => 'Session driver',    'value' => config('session.driver')],
			['name' => 'Queue driver',      'value' => config('queue.default')],
			
			['name' => 'Timezone',          'value' => config('app.timezone')],
			['name' => 'Locale',            'value' => config('app.locale')],
			['name' => 'Env',               'value' => config('app.env')],
			['name' => 'URL',               'value' => config('app.url')],
		];
		
		
		$data = [
			'data'=>auth()->user(),
			'dependencies'=>$this->dependencies(),
			'envs' => $envs
		];
		return view('admin.index',$data);
	}
	
	public function dependencies()
	{
		$json = file_get_contents(base_path('composer.json'));
		
		$dependencies = json_decode($json, true)['require'];
		
		return  $dependencies;
	}
	
	
	public function CropAvatar(Request $request,User $user,ImageModel $image_model)
	{
		
		
		try {
			$this->authorize( 'update' , $user );
		} catch ( AuthorizationException $e ) {
			
			$response = array(
				'state'  => false,
				'message' => '暂无权限修改',
				'result' => ''
			);
			return response()->json($response);
		}
		$data = $request->get('avatar_data');
		$data = json_decode($data,true);
		$file = $request->file('avatar_file');
		if ($file->isValid())
		{
			$extension = $file->getClientOriginalExtension();
			$image = Image::make($file);
			$img = $image->rotate(-floatval($data['rotate']))->crop((int)$data['width'],(int)$data['height'],(int)$data['x'],(int)$data['y'] );
			$img->resize(300,300);
			$path  = self::AVATAR_PATH.DIRECTORY_SEPARATOR.$user->id.DIRECTORY_SEPARATOR.randByMicrosecond().'.'. $extension;
			Storage::disk('public')->put($path, $img->save());
			DB::beginTransaction();
			try {
				$image_res = $image_model->setOneData($user,$file,$path);
				$user_data['avatar'] = $image_res->id;
				$user->update($user_data);
				$web_path = route('imagecache',['template'=>'small','filename'=>$path]);
				DB::commit();
			}catch ( Exception $exception){
				DB::rollBack();
				$response = array(
					'state'  => false,
					'message' => $exception->getMessage(),
					'result' => ''
				);
				return response()->json($response);
			}
			$response = array(
				'state'  => true,
				'message' => '上传成功',
				'result' => $web_path
			);
			return response()->json($response);
		}else{
			$response = array(
				'state'  => false,
				'message' => '文件损坏，请重新选择',
				'result' => ''
			);
			return response()->json($response);
		}
	}
}