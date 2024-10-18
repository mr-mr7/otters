<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        config(['app.url' => 'http://127.0.0.1:8000/api/v1']);
        URL::forceRootUrl('http://127.0.0.1:8000/api/v1');

        Artisan::call('migrate:refresh');
        $this->artisan('db:seed');
    }
}
