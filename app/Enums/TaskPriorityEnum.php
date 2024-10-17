<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TaskPriorityEnum: int
{
    use EnumToArray;

    case LOW = 10;
    case MEDIUM = 50;
    case HIGH = 90;

    public static function getLabel($val): string
    {
        return match ($val) {
            self::LOW, self::LOW->value => 'کم',
            self::MEDIUM, self::MEDIUM->value => 'متوسط',
            self::HIGH, self::HIGH->value => 'بالا',
        };
    }

    public static function getHtmlTag($val): string
    {
        return match ($val) {
            self::LOW, self::LOW->value => '<span class="badge bg-primary">کم</span>',
            self::MEDIUM, self::MEDIUM->value => '<span class="badge bg-warning">متوسط</span>',
            self::HIGH, self::HIGH->value => '<span class="badge bg-danger">بالا</span>',
        };
    }
}
