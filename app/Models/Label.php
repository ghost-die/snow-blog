<?php

namespace App\Models;

use App\Models\traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use ModelTrait;
	protected $fillable = [
		'name',
		'color',
		'num',
		
	];
	
	
//	public function getOrSet ( $data ,$float = false)
//	{
//
//		try {
//			return  $this->query()->where($data)->firstOrFail();
//
//
//		}catch (\Exception $exception){
//
//			$data = array_merge($data,['num'=>1]);
//			return $this->set($data);
//		}
//	}
	
	public function article()
	{
		return $this->belongsToMany(Article::class,'article_to_label','label_id','article_id');
	}
}
