<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Lib\Layout\Content;
use App\Models\User;
use App\Traits\HasAdminResourceActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
	use HasAdminResourceActions;
	
	protected $title = 'User';
	
	
	
	public $input = [
		'name',
		'email',
		'password',
	];
	
	public $home = 'user';
	
	
	public $model = User::class;
	
	
	public function grid()
	{
		$this->data = [
			'data'=>$this->data()
		];
		
		$this->setView('users.index');
		
		return view($this->view,$this->data);
	}
	
	
	
	public function edit(User $user)
	{
		$this->setData([
			'data' =>$user
		]);
		$this->setView('users.edit');
		return view($this->view,$this->data);
		
	}
	
	public function update(User $user,Request $request)
	{
		$user->name = $request->name ;
		$user->email = $request->email ;
		
		$user->save();
		
		return notification('操作成功','success',route('admin.user.index'));
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
			
			return notification('操作成功','success',admin_url($this->home));
		}catch (\Exception $exception)
		{
			return notification($exception->getMessage(),'error');
		}
		
	}
	
}