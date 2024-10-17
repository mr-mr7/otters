<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = ['title', 'des', 'status', 'priority', 'end_at'];

    protected $appends = ['status_label', 'priority_label'];

    protected $casts = [
        'end_at' => 'datetime'
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

    public function getCreatedAtAttribute()
    {
        return isset($this->attributes['created_at']) ? verta($this->attributes['created_at']) : null;
    }

    public function getEndAtAttribute()
    {
        return isset($this->attributes['end_at']) ? verta($this->attributes['end_at']) : null;
    }
    // ============= Function ==============
}
