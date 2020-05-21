<?php

namespace App\Models;

use App\Models\traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
	
	use ModelTrait;
	
	protected $fillable = [
		'name', 'user_id', 'icon',
	];
	
	
	
	public function article()
	{
		return $this->hasMany(Article::class,'category_id','id');
	}
	
}
