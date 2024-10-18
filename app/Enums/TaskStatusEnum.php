<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TaskStatusEnum: int
{
    use EnumToArray;

    case POSTPONED = -100;
    case NEW = 0;
    case PROCESSING = 10;
    case COMPLETE = 100;

    public function label()
    {
        return self::getLabel($this->value);
    }

    public static function getLabel($val): string
    {
        return match ($val) {
            self::NEW, self::NEW->value => 'جدید',
            self::POSTPONED, self::POSTPONED->value => 'به تعویق افتاده',
            self::PROCESSING, self::PROCESSING->value => 'در حال انجام',
            self::COMPLETE, self::COMPLETE->value => 'کامل شده',
        };
    }

    public static function getHtmlTag($val): string
    {
        return match ($val) {
            self::NEW, self::NEW->value => '<span class="badge bg-primary">جدید</span>',
            self::POSTPONED, self::POSTPONED->value => '<span class="badge bg-danger">به تعویق افتاده</span>',
            self::PROCESSING, self::PROCESSING->value => '<span class="badge bg-info">در حال انجام</span>',
            self::COMPLETE, self::COMPLETE->value => '<span class="badge bg-success">انجام شده</span>',
        };
    }
}
