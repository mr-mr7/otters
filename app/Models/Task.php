<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = ['title', 'des', 'status', 'priority', 'end_at'];

    protected $appends = ['status_label', 'priority_label','jalali_created_at','jalali_end_at'];

    protected $casts = [

    ];

    // ============= Relation ==============
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // ============= Mutator ==============
    // ============= Accessor ==============
    public function getStatusLabelAttribute()
    {
        return isset($this->attributes['status']) ? TaskStatusEnum::getLabel($this->attributes['status']) : null;
    }

    public function getPriorityLabelAttribute()
    {
        return isset($this->attributes['priority']) ? TaskPriorityEnum::getLabel($this->attributes['priority']) : null;
    }

    public function getStatusTagAttribute()
    {
        return isset($this->attributes['status']) ? TaskStatusEnum::getHtmlTag($this->attributes['status']) : null;
    }

    public function getPriorityTagAttribute()
    {
        return isset($this->attributes['priority']) ? TaskPriorityEnum::getHtmlTag($this->attributes['priority']) : null;
    }

    public function getJalaliCreatedAtAttribute()
    {
        return isset($this->attributes['created_at']) ? verta($this->attributes['created_at']) : null;
    }

    public function getJalaliEndAtAttribute()
    {
        return isset($this->attributes['end_at']) ? verta($this->attributes['end_at']) : null;
    }
    // ============= Function ==============
}
