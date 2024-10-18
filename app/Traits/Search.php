<?php

namespace App\Traits;

use App\Models\User;

trait Search
{
    public $filter = [];

    // وقتی میخواییم بر اساس یه فیلد جستجو کنیم مثلا:
    // wire:click="filter('age',18)"
    public function filter(string $filter_name, ?string $filter_value): void
    {
        if (is_null($filter_value)) {
            unset($this->filter[$filter_name]);
        } else {
            $this->filter[$filter_name] = $filter_value;
        }
    }


    public function search()
    {
        $this->filter = array_filter($this->filter);
        $this->dispatch('closeModal');
    }
}
