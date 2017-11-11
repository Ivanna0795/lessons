<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    protected $table = 'task';
	public function lessonType() {
		return $this->belongsTo('App\Lesson','lesson_id','id');
	}
}
