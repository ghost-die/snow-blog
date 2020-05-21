<?php


namespace App\Traits;



use Illuminate\Http\Request;

trait HasAdminResourceActions
{
	protected $validate = [];
	
	
	protected $validateMessage = [];
	
	
	
	protected $view = '';
	
	
	protected $data = [];
	
	
	public function data()
	{
		return $this->model::orderBy('created_at','DESC')->paginate(15);
	}
	
	
	
	public function view ()
	{
		
		return view($this->view,$this->data);
	}
	
	/**
	 * @param string $view
	 */
	public function setView ( string $view ) : void
	{
		$this->view = 'admin.'.$view;
	}
	
	/**
	 * @param array $data
	 */
	public function setData ( array $data ) : void
	{
		$this->data = $data;
	}
	
	
	/**
	 * @param Request $request
	 * @return array
	 */
	public function validationMessages(Request $request)
	{
		return $request->validate($this->validate,$this->validateMessage);
		
	}
}