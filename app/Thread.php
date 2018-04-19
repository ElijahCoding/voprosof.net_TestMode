<?php

namespace App;

use App\Reply;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
      parent::boot();

      static::addGlobalScope('replyCount', function ($builder) {
         $builder->withCount('replies');
      });

      static::deleting(function ($thread) {
        $thread->replies->each->delete();
        // $thread->replies->each(function($reply) {
        //   $reply->delete();
        // });
      });

      // static::created(function ($thread) {
      //   $thread->recordActivity('created');
      // });
    }


    public function path()
    {
      return "/threads/" . $this->channel->slug . '/' . $this->id;
    }

    public function replies()
    {
      return $this->hasMany(Reply::class);
    }

    public function creator()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
      return $this->belongsTo(Channel::class);
    }

    public function addReply($reply)
    {
      $this->replies()->create($reply);
    }

    public function scopeFilter($builder, $filters)
    {
      return $filters->apply($builder);
    }
}
