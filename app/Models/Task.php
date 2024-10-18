<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = ['title', 'des', 'status', 'priority', 'end_at'];

    protected $appends = ['status_label', 'priority_label','jalali_created_at','jalali_end_at'];

    // ============= Relation ==============
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // ============= Mutator ==============
    // ============= Accessor ==============
    /**
     * label for status
     * @return string|null
     */
    public function getStatusLabelAttribute(): ?string
    {
        return isset($this->attributes['status']) ? TaskStatusEnum::getLabel($this->attributes['status']) : null;
    }

    /**
     * label for priority
     * @return string|null
     */
    public function getPriorityLabelAttribute(): ?string
    {
        return isset($this->attributes['priority']) ? TaskPriorityEnum::getLabel($this->attributes['priority']) : null;
    }

    /**
     * HTML tag for status
     * @return string|null
     */
    public function getStatusTagAttribute(): ?string
    {
        return isset($this->attributes['status']) ? TaskStatusEnum::getHtmlTag($this->attributes['status']) : null;
    }

    /**
     * HTML tag for priority
     *
     * @return string|null
     */
    public function getPriorityTagAttribute(): ?string
    {
        return isset($this->attributes['priority']) ? TaskPriorityEnum::getHtmlTag($this->attributes['priority']) : null;
    }

    /**
     * convert created_at to Jalali
     * @return string|null
     */
    public function getJalaliCreatedAtAttribute(): ?string
    {
        return isset($this->attributes['created_at']) ? verta($this->attributes['created_at'])->format('Y-m-d H:i:s') : null;
    }

    /**
     * convert end_at to Jalali
     *
     * @return string|null
     */
    public function getJalaliEndAtAttribute(): ?string
    {
        return isset($this->attributes['end_at']) ? verta($this->attributes['end_at'])->format('Y-m-d H:i:s') : null;
    }
    // ============= Function ==============
}
