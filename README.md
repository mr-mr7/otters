<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## ABOUT THIS PROJECT
This project is a simple and test project for work with laravel and livewire with useful feature like
- `queue`
- `broadcasting`
- `reverb`
- `service layer`
- `service container`
- `livewire`
- `spatie query builder`
- `test`
- `fortify`
- `observer`
- `event`
- `accessor`
- ....

#### Notice: application test isn't complete just I wrote some test for test
#### TaskService: `TaskService` can be better with use interface and inject interface task service to use it


## RUN ON LOCALHOST

- `sail composer install`
- `sail up -d`
- `sail artisan migrate`
- `sail artisan reverb start`
- `sail artisan queue:work --queue=high,medium,default`
