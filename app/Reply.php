<?php

namespace App;

use App\Traits\Favoritable;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    protected $appends = ['favoritesCount', 'isFavorited'];

    // public static function boot()
    // {
    //   parent::boot();
    //
    //   static::deleting(function($model) {
    //     $model->favorites->each->delete();
    //   });
    // }

    public function owner()
    {
      return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function thread()
    {
      return $this->belongsTo(Thread::class);
    }

    public function path()
    {
      return $this->thread->path() . "#reply-{$this->id}";
    }
}
