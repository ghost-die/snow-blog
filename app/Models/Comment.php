<?php

namespace App\Models;

use App\Models\traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use ModelTrait;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'article_id',
		'parent_id',
		'name',
		'email',
		'content',
		'web_site',
		'avatar',
	];
	
	
	public function getCreatedAtAttribute ( $created_at )
	{
		return Carbon::parse($created_at)->toDayDateTimeString();
	}
	
	
	public function article()
	{
		return $this->hasOne(Article::class,'id','article_id');
	}
}
