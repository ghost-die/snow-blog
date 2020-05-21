<?php


namespace App\Models;


use App\Models\traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	use ModelTrait;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'path', 'ext','size', 'mime_tye','hash'
	];
	
	
	
	
	public function getAllByUserId(int $user_id)
	{
		return $this->query()->where(['user_id'=>$user_id])->get();
	}
	
	public function setOneData(User $user,object $file,string $path,string $hash)
	{
		$extension = $file->getClientOriginalExtension();
		
		$size = $file->getSize();
		
		$mimeTye = $file->getClientMimeType();
		
		$image_user_data['user_id'] = $user->id;
		$image_user_data['path'] = $path;
		$image_user_data['ext'] = $extension;
		$image_user_data['size'] = $size;
		$image_user_data['mime_tye'] = $mimeTye;
		$image_user_data['hash'] = $hash;
		
		return $this->set($image_user_data);
	}
}