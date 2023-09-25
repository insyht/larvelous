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
- php artisan vendor:publish --tag=insyht-larvelous

## Set locale language to Dutch
/config/app.php Change 'locale' to 'nl'

## Other steps
- Run a password reset for the IWS account, so that a new password can be set
- Remove the default Laravel "/" route from routes/web.php

