These Commands are used to make this. DO NOT RUN THESE.
Please refer to README.MD for commands to run after git pull.

```
laravel new SISKOPv3 --git
php artisan key:generate
composer require laravel/jetstream
php artisan jetstream:install livewire
php artisan vendor:publish --tag=jetstream-views
npm install && npm run dev
composer require arcanedev/log-viewer
php artisan log-viewer:publish --tag=config
composer require barryvdh/laravel-debugbar --dev
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
composer require --dev barryvdh/laravel-ide-helper
php artisan ide-helper:generate
composer require owen-it/laravel-auditing
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="config"
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="migrations"
```