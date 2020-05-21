<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasAdminResourceActions;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	use HasAdminResourceActions;
	
	
	public $input = [
		'name',
		'email',
		'password',
	];
	
	public $home = 'user';
	
	
	public $model = User::class;
	
	public function index()
	{
		
		$this->data = [
			'data'=>$this->data()
		];
		
		$this->setView('users.index');
		
		return $this->view();
	}
	
	
	public function store()
	{
		$data = request($this->input);
		
		
		try {
			$this->model::create([
				'name'=>$data['name'],
				'email'=>$data['email'],
				'password'=>Hash::make($data['password']),
				'avatar'=>make_gravatar($data['email'],200),
			]);
			
			return redirect(admin_url($this->home))->with('success','操作成功');
		}catch (\Exception $exception)
		{
			return back()->with('error',$exception->getMessage());
		}
		
	}
	
}