- Seeder maken die alle data die ik nu heb, bevat. Op die manier kan ik zonder problemen migraties terug -en vooruitspoelen
- Dit moet voor elke plugin worden uitgevoerd elke keer als een plugin wordt geupdate via het systeem (de tag is str_replace('/', '-', $plugin->path)):
  - php artisan vendor:publish --tag=insyht-larvelous-shop --force
- Even de TODOs nalopen in larvelous-shop
- Deployment werkt niet meer, hij loopt te zeuren over een missende versie van insyht/larvelous
- Larvelous-base-blocks (en Larvelous zelf) ombouwen tot Laravel packages: https://laravel.com/docs/10.x/packages
- Unit en feature test in larvelous-shop werkend maken


Larvelous package:
- Alle views moeten nu met namespace (insyht-larvelous::) genoemd worden
- composer.json van iwscms2 nalopen en opschonen
- Checken of alles op iwscms2.local net zo werkt als op iwscms.local
- Kijken of ik met een script o.i.d. de standaard / route uit routes/web.php kan slopen van een Laravel installatie. Hij staat nu nog als handmatige stap in INSTALL.md
- larvelous-base-blocks moet een dependency krijgen op larvelous via Composer. Dat werkte niet goed wanneer ik dat deed en ik bijv een composer update deed in iwscms2
- Kaal Laravel project starten en dan kijken wat ik moet doen om Larvelous erin werkend te krijgen, en dit noteren in een .md in Larvelous
