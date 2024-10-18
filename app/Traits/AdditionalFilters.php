<?php

namespace App\Traits;

use Carbon\Carbon;

trait AdditionalFilters
{
    public function scopeStartCreatedAt($query, $from)
    {
        return $query->where('created_at', '>=', $from);
    }

    public function scopeEndCreatedAt($query, $to)
    {
        return $query->where('created_at', '<=', $to);
    }
}
