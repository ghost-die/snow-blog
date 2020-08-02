<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasAdminResourceActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
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
	
	
	public function edit(User $user)
	{
		$this->setData([
			'data' =>$user
		]);
		$this->setView('users.edit');

		return $this->view();
		
//		print_r($user);
//
//		return view('admin.users.edit',['data'=>$user]);
	}
	
	public function update(User $user,Request $request)
	{
		$user->name = $request->name ;
		$user->email = $request->email ;
		
		$user->save();
		
		return notification('操作成功','success');
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