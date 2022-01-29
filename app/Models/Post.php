<?php

namespace App\Models;


use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    //protected $fillable = ['name','description'];
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo('App\Models\category','category_id');
    }

    protected static function booted()
    {
        static::created(function ($post) {
            Mail::to('khantphone333@gmail.com')->send(new PostCreated($post));
            
        });
        static::updated(function ($post) {
            Mail::to('khantphone333@gmail.com')->send(new PostUpdated($post));
            
        });
        static::deleted(function ($post) {
            Mail::to('khantphone333@gmail.com')->send(new PostDeleted($post));
            
        });
    }
    
};
