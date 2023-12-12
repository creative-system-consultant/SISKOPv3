# SISKOP PORTAL v3

Siskop PORTAL v3. Developed for [Creative Systems Consultant](http://www.csc.net.my/)

## Description

An in-depth paragraph about your project and overview of use.

## Features
Logviewer : url/log-viewer

## Getting Started

### Dependencies

* MS SQL SERVER
* PHP 8.0
* SQL SRV DRIVER (Both PDO & non-PDO)

### Installing

* Pull from github
* run commands

### Commands

Install after pull

```
composer install
copy .env.example .env
php artisan storage:link
php artisan key:generate
php artisan ide-helper:generate
npm install
npm run dev
```

## General Issue
when using SQLSERVER 2012 and PHP driver for MAC **MSODBCSQL17**, theres a PHP bug in PDO
[buglink](https://github.com/laravel/framework/issues/47937)
deleting the line __*PDO::ATTR_STRINGIFY_FETCHES => false,*__ 
in file *vendor/laravel/framework/src/illuminate/Database/connectors/SqlServerConnector.php* does do the trick.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## This project uses these:


* [Laravel](https://github.com/laravel/laravel)
* [livewire AlpineJS](https://laravel-livewire.com)
* [ARCANEV Logviewer](https://github.com/ARCANEDEV/LogViewer)
* [owen-it Laravel-auditing](https://github.com/owen-it/laravel-auditing)
* [barryvdh laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
* [barryvdh laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
* [HEROICON Blade](https://github.com/blade-ui-kit/blade-heroicons)