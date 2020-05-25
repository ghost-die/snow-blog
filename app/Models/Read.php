<?php

namespace App\Models;

use App\Models\traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
	use ModelTrait;
	
	protected $fillable = [
		'ip',
		'article_id'
	];
    
    public function checkout($ip,$article_id)
    {
        if ($this->be(['ip'=>$ip,'article_id'=>$article_id]))
        {
        	return true;
        }else{
        	return false;
        }
    }
    
}
