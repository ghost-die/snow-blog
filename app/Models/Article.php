<?php

namespace App\Models;

use App\Models\traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Parsedown;

class Article extends Model
{
	
	use ModelTrait;
	
	protected $fillable = [
		'user_id',
		'category_id',
		'title',
		'content',
		'reads_num',
		'comments_num',
		'author',
		'original_content',
	];
	
	
	public function getLast()
	{
		return $this->query()->orderBy('created_at','DESC')->first();
	}
	
	public function getPaginateData()
	{
		
		return $this->query()->orderBy('created_at','DESC')->paginate(15);
		
	}
	
	public function setArticle(array $data,Label $label,ArticleCategory $articleCategory,User $user)
	{
		
		$articles['title'] = $data['title'];
		$articles['original_content'] = $data['content'];
		$articles['content'] = (new Parsedown())->parse($data['content']);
		$articles['category_id'] = $data['category_id'];
		$articles['author'] = $user->name;
		$articles['user_id'] = $user->id;
		
		DB::beginTransaction();
		
		try {
			$article_data = $this->set($articles);
			$articleCategory->bcInc($articles['category_id'],'article_num',1);
			collect($data['label'])->each(function ($v) use (&$label,$article_data){
				$label_data = $label->getOrSet(['name'=>$v]);
				DB::table('article_to_label')->insert(
					[
						'article_id'=>$article_data->id,
						'label_id'=>$label_data->id,
						'created_at'=>Carbon::now(),
						'updated_at'=>Carbon::now(),
					]
				);
			});
			
			DB::commit();
			return true;
		}catch (\Exception $exception){
			DB::rollBack();
			
			$this->setError($exception->getMessage());
			return false;
		}
	}
	
	
	
	public function updateArticle(array $data ,Article $article,Label $label)
	{
		DB::beginTransaction();
		try {
			$article->category_id = $data['category_id'];
			$article->title = $data['title'];
			$article->original_content = $data['content'];
			$article->content = (new Parsedown())->parse($data['content']);
			
			$article->save();
			
			collect($data['label'])->each(function ($v) use (&$label,$article){
				$label_data = $label->getOrSet(['name'=>$v]);
				
				$num = DB::table('article_to_label')->where([
					'article_id'=>$article->id,
					'label_id'=>$label_data->id,
				])->count();
				if (! ($num > 0))
				{
					DB::table('article_to_label')->insert(
						[
							'article_id'=>$article->id,
							'label_id'=>$label_data->id,
							'created_at'=>Carbon::now(),
							'updated_at'=>Carbon::now(),
						]
					);
				}
				
			});
			DB::commit();
			return true;
		}catch (\Exception $exception)
		{
			DB::rollBack();
			
			$this->setError($exception->getMessage());
			return false;
		}
		
		
		
	}
	
	public function getCreatedAtAttribute ( $created_at )
	{
		return Carbon::parse($created_at)->diffForHumans();
	}
	
	
	
	public function readAdd(string $ip,Article $article,Read $read)
	{
		if (! $read->checkout($ip,$article->id))
		{
			$data['ip']=$ip;
			$data['article_id']=$article->id;
			$read->set($data);
			
			$article->reads_num +=1;
			$article->save();
			
			return  true;
		}else{
			return false;
		}
	}
	
	
	
	
	public function label()
	{
		return $this->belongsToMany(Label::class, 'article_to_label','article_id','label_id');
	}
	
	public function category()
	{
		return $this->hasOne(ArticleCategory::class,'id','category_id');
	}
	
	
	public function comment()
	{
		return $this->hasMany(Comment::class);
	}
}
