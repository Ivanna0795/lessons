<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function lessonType() {
		return $this->belongsTo('App\Lesson','lesson_id','id');
	}
}
