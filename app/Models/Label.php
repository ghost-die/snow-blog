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
	
	
	public function getOrSet ( $data ,$float = false)
	{
		
		try {
			$res = $this->query()->where($data)->firstOrFail();
		
			if ($float)
			{
				return  $res;
			}else{
				$res->num +=1;
				$res->save();
				return $res;
			}
			
		}catch (\Exception $exception){
		
			return $this->set($data);
		}
	}
	
	public function article()
	{
		return $this->belongsToMany(Article::class,'article_to_label','label_id','article_id');
	}
}
