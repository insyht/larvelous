# Install notes
## Correct Livewire path
- php artisan livewire:publish && nano config/livewire.php
  - set 'asset_url' to the full url to the public dir, for example "https://www.iwsklanten.nl/iwscms/public"

## Create symbolic link for uploaded images and more
- php artisan storage:link

## Build the CSS and JS
### First, run this from within the plugin directory:
- npm run build
### Next, run this from within the project:
- php artisan vendor:publish --tag=insyht-larvelous --force

## Set locale language to Dutch
/config/app.php Change 'locale' to 'nl'

## Other steps
- Run a password reset for the IWS account, so that a new password can be set
- Remove the default Laravel "/" route from routes/web.php

# Install notes - beta
- composer create-project laravel/laravel jordytest
- correct .env (especially the database config)
	APP_URL=https://jordytest.local
	DB_CONNECTION=mysql
	DB_HOST=mysql
	DB_PORT=3306
	DB_DATABASE=jordytest
	DB_USERNAME=root
	DB_PASSWORD=

- create database


	(repositories toevoegen aan de composer.json zolang de packages nog niet in Packagist staan)
   "repositories": [
        {
            "type": "path",
            "url": "../packages/larvelous-shop"
        },
        {
            "type": "path",
            "url": "../packages/larvelous"
        }
    ]
    minimum stability op dev zetten
    composer install


- composer require insyht/larvelous:"dev-package"
- composer require insyht/larvelous-shop:"dev-develop"
- php artisan vendor:publish --tag=insyht-larvelous
- php artisan vendor:publish --tag=insyht-larvelous-shop
- routes/web.php leeg maken

	ln -s public public_html

- /app/Models/User.php:
    - Voeg "implements \Filament\Models\Contracts\FilamentUser" toe aan de class
    - Zet bij "use" ook "\Spatie\Permission\Traits\HasRoles"
    - Voeg deze functie toe: public function canAccessFilament(): bool { return true; }
- database\seeders\DatabaseSeeder.php: voeg dit toe in de run(): $this->call([\Insyht\Larvelous\Database\Seeders\DatabaseSeeder::class]);

- php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

- php artisan migrate:fresh --seed

locale in config/app.php op 'nl' zetten (is standaard 'en')

