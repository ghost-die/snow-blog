<?php

namespace App\Models;

use App\Models\traits\UserRoles;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use UserRoles;
	
	use Notifiable {
		notify as protected laravelNotify;
	}
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    
    
    //*** 关联表
    
	public function image()
	{
		return $this->hasOne(Image::class,'user_id','id');
	}
	
	
	public function article_category()
	{
		return $this->hasMany(ArticleCategory::class,'user_id','id');
	}
	
	
	public function article()
	{
		return $this->hasMany(Article::class,'user_id','id');
	}
	
	
	
	

//	public function getAvatarAttribute ( $avatar )
//    {
//
//	    try {
//		    $image_data = (new Image())->query()->findOrFail($avatar)->toArray();
//
//
//
//		    return route('imagecache',['template'=>'small','filename'=>$image_data['path']]);
//	    }catch (\Exception $exception){
//	    	return route('imagecache',['template'=>'small','filename'=>'1']);
//	    }
//
//
//    }
}
