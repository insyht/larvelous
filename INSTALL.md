# Install notes
## Correct Livewire path
- php artisan livewire:publish && nano config/livewire.php
  - set 'asset_url' to the full url to the public dir, for example "https://www.iwsklanten.nl/iwscms/public"

## Create symbolic link for uploaded images and more
- php artisan storage:link

## Build the CSS and JS
- npm run build

- Run a password reset for the IWS account, so that a new password can be set

